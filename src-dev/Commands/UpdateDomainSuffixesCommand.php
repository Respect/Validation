<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Commands;

use Respect\Dev\Helpers\DataSaver;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use function array_keys;
use function array_unique;
use function count;
use function dirname;
use function explode;
use function file_get_contents;
use function glob;
use function idn_to_ascii;
use function is_dir;
use function mb_strtoupper;
use function mkdir;
use function preg_match;
use function rmdir;
use function sort;
use function sprintf;
use function str_replace;
use function str_starts_with;
use function trim;
use function unlink;

use const IDNA_DEFAULT;
use const INTL_IDNA_VARIANT_UTS46;

#[AsCommand(
    name: 'update:domain-suffixes',
    description: 'Update list of public domain suffixes',
)]
final class UpdateDomainSuffixesCommand extends Command
{
    private const string LIST_URL = 'https://publicsuffix.org/list/public_suffix_list.dat';

    public function __construct(
        private readonly DataSaver $dataSaver,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Updating domain suffixes');

        // Download the list
        $io->section('Downloading list');
        $io->text(sprintf('Fetching from: %s', self::LIST_URL));

        $listContent = file_get_contents(self::LIST_URL);
        if ($listContent === false) {
            $io->error('Failed to download public suffix list');

            return Command::FAILURE;
        }

        $io->success('Downloaded successfully');

        // Clean old data
        $io->section('Removing old data');
        $dataDir = dirname(__DIR__, 2) . '/data/domain';
        $this->removeDirectory($dataDir . '/public-suffix');

        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0777, true);
        }

        mkdir($dataDir . '/public-suffix', 0777, true);
        $io->success('Old data removed');

        // Process the list
        $io->section('Processing public suffix list');

        $suffixes = $this->parseTldsList($listContent);
        $tlds = array_unique(array_keys($suffixes));
        sort($tlds);

        $io->text(sprintf('Found %d TLDs with suffixes', count($tlds)));

        // Create files
        $io->section('Creating suffix files');
        $progressBar = $io->createProgressBar(count($tlds));
        $progressBar->start();

        foreach ($tlds as $tld) {
            $suffixList = $suffixes[$tld];
            if ($suffixList === []) {
                $progressBar->advance();
                continue;
            }

            $punycodedTld = idn_to_ascii($tld, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46) ?: $tld;

            $this->dataSaver->save(
                $suffixList,
                '2007–22 Mozilla Foundation',
                'MPL-2.0-no-copyleft-exception',
                sprintf('domain/public-suffix/%s.php', $punycodedTld),
            );

            $progressBar->advance();
        }

        $progressBar->finish();
        $io->newLine(2);

        $io->success('Domain suffixes updated successfully');

        return Command::SUCCESS;
    }

    /** @return array<string, array<string>> */
    private function parseTldsList(string $content): array
    {
        $lines = explode("\n", $content);
        $suffixes = [];
        $icannOnly = true;

        foreach ($lines as $line) {
            $line = trim($line);

            // Check if we've reached the end of ICANN domains
            if ($line === '// ===END ICANN DOMAINS===') {
                $icannOnly = false;
            }

            // Skip comments and empty lines
            if ($line === '' || str_starts_with($line, '//')) {
                continue;
            }

            // Process the suffix
            $suffix = $line;

            // Remove wildcards and exceptions
            $suffix = str_replace('*.', '', $suffix);
            $suffix = str_replace('!', '', $suffix);

            // Convert to uppercase (using multibyte for international characters)
            $suffix = mb_strtoupper($suffix, 'UTF-8');

            // Split into TLD and prefix
            if (!preg_match('/^([^.]+)$|^(.+)\.([^.]+)$/', $suffix, $matches)) {
                continue;
            }

            if (isset($matches[3])) {
                // Has a prefix
                $tld = $matches[3];
                $prefix = $matches[2];

                if (!isset($suffixes[$tld])) {
                    $suffixes[$tld] = [];
                }

                // Only add ICANN domains
                if ($icannOnly) {
                    $suffixes[$tld][] = $prefix . '.' . $tld;
                }
            } else {
                // Just a TLD
                $tld = $matches[1];
                if (!isset($suffixes[$tld])) {
                    $suffixes[$tld] = [];
                }
            }
        }

        return $suffixes;
    }

    private function removeDirectory(string $directory): void
    {
        if (!is_dir($directory)) {
            return;
        }

        $files = glob($directory . '/*');
        if ($files === false) {
            return;
        }

        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->removeDirectory($file);
            } else {
                @unlink($file);
            }
        }

        @rmdir($directory);
    }
}

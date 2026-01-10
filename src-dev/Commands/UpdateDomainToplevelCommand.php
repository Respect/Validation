<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
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

use function count;
use function explode;
use function file_get_contents;
use function sprintf;
use function str_starts_with;
use function trim;

#[AsCommand(
    name: 'update:domain-toplevel',
    description: 'Update list of Top Level Domains (TLD) in the Tld validator',
)]
final class UpdateDomainToplevelCommand extends Command
{
    private const string LIST_URL = 'https://data.iana.org/TLD/tlds-alpha-by-domain.txt';

    public function __construct(
        private readonly DataSaver $dataSaver,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Updating TLD list');

        // Download the list
        $io->section('Downloading list');
        $io->text(sprintf('Fetching from: %s', self::LIST_URL));

        $listContent = file_get_contents(self::LIST_URL);
        if ($listContent === false) {
            $io->error('Failed to download TLD list');

            return Command::FAILURE;
        }

        $io->success('Downloaded successfully');

        // Process the list
        $io->section('Processing TLD list');

        $lines = explode("\n", trim($listContent));
        $tlds = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            $tlds[] = $line;
        }

        $this->dataSaver->save(
            $tlds,
            '(c) https://data.iana.org/TLD/',
            'MPL-2.0',
            'domain/tld.php',
        );

        $io->success('Updated successfully');
        $io->text(sprintf('Total TLDs: %d', count($tlds)));

        return Command::SUCCESS;
    }
}

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
use function preg_replace_callback;
use function sprintf;
use function str_contains;
use function str_starts_with;
use function strlen;
use function trim;

#[AsCommand(
    name: 'update:postal-codes',
    description: 'Update the list of postal codes in the PostalCode validator',
)]
final class UpdatePostalCodesCommand extends Command
{
    private const string LIST_URL = 'https://download.geonames.org/export/dump/countryInfo.txt';

    public function __construct(
        private readonly DataSaver $dataSaver,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Updating postal codes list');

        // Download the list
        $io->section('Downloading list');
        $io->text(sprintf('Fetching from: %s', self::LIST_URL));

        $listContent = file_get_contents(self::LIST_URL);
        if ($listContent === false) {
            $io->error('Failed to download postal codes list');

            return Command::FAILURE;
        }

        $io->success('Downloaded successfully');

        // Process the list
        $io->section('Processing postal codes');

        $lines = explode("\n", $listContent);
        $postalCodes = [];

        foreach ($lines as $line) {
            $line = trim($line);

            // Skip comments and empty lines
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            // Split by tab
            $parts = explode("\t", $line);
            if (count($parts) < 15) {
                continue;
            }

            $countryCode = $parts[0];
            $countryFormat = $parts[13];
            $countryRegex = trim($parts[14]);

            if ($countryRegex === '') {
                continue;
            }

            // Convert format
            $countryFormat = preg_replace_callback('/(#+|@+)/', static function ($matches) {
                $length = strlen($matches[0]);
                $regex = str_contains($matches[0], '#') ? '\d' : '\w';
                if ($length > 1) {
                    $regex .= '{' . $length . '}';
                }

                return $regex;
            }, $countryFormat);

            $postalCodes[$countryCode] = ['/^' . $countryFormat . '$/', '/' . $countryRegex . '/'];
        }

        $this->dataSaver->save(
            $postalCodes,
            '(c) https://download.geonames.org/export/dump/countryInfo.txt',
            'CC-BY-4.0',
            'postal-code.php',
        );

        $io->success('Updated successfully');
        $io->text(sprintf('Total postal codes: %d', count($postalCodes)));

        return Command::SUCCESS;
    }
}

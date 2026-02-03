<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Commands;

use Respect\Validation\Test\SmokeTestProvider;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function array_diff;
use function array_filter;
use function array_keys;
use function array_map;
use function count;
use function dirname;
use function iterator_to_array;
use function lcfirst;
use function scandir;
use function str_ends_with;
use function substr;

#[AsCommand(
    name: 'smoke-tests:check-complete',
    description: 'Verifies if all validators are included in the SmokeTestProvider',
)]
final class SmokeTestsCheckCompleteCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $validatorDir = dirname(__DIR__, 2) . '/src/Validators';

        $missingSmokeTests = array_diff(
            array_map(
                static fn(string $fileName) => lcfirst(substr($fileName, 0, -4)),
                array_filter(
                    scandir($validatorDir),
                    static fn(string $fileName) => str_ends_with($fileName, '.php'),
                ),
            ),
            array_map(
                lcfirst(...),
                array_keys(
                    iterator_to_array((new class {
                            use SmokeTestProvider;
                    })->provideValidatorInput()),
                ),
            ),
        );

        if (count($missingSmokeTests) > 0) {
            $output->writeln('The following validators are missing from the SmokeTestProvider:');
            foreach ($missingSmokeTests as $validatorName) {
                $output->writeln('- ' . $validatorName);
            }

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}

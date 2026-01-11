<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Dev\Commands;

use Respect\Dev\Markdown\Differ;
use Respect\Dev\Markdown\File;
use Respect\Dev\Markdown\Linter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

use function count;
use function dirname;
use function sprintf;

#[AsCommand(
    name: 'docs:lint',
    description: 'Apply documentation linters and optionally auto-fix issues',
)]
final class DocsLintCommand extends Command
{
    public function __construct(
        private readonly Differ $differ,
        private readonly Linter $linter,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption(
            'fix',
            null,
            null,
            'Automatically fix files with issues.',
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $finder = new Finder();
        $finder->in(dirname(__DIR__, 2) . '/docs')->files()->name('*.md');

        $lintedFiles = [];
        foreach ($finder as $file) {
            $original = File::from($file);
            $linted = $this->linter->lint($original);
            if ($linted === $original) {
                continue;
            }

            $lintedFiles[] = $linted;

            $output->writeln($this->differ->diff($original, $linted));
        }

        if ($lintedFiles === []) {
            $output->writeln('<info>No changes needed.</info>');
        } else {
            $output->writeln(sprintf('<comment>Changes needed in %d files.</comment>', count($lintedFiles)));
        }

        if ($lintedFiles !== [] && !$input->getOption('fix')) {
            return Command::FAILURE;
        }

        foreach ($lintedFiles as $linted) {
            $linted->save();
        }

        return Command::SUCCESS;
    }
}

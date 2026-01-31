<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 */

declare(strict_types=1);

namespace Respect\Dev\Commands;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\ValidatorBuilder;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

use function array_filter;
use function array_keys;
use function array_map;
use function dirname;
use function explode;
use function file_get_contents;
use function preg_match;
use function sprintf;
use function trim;

#[AsCommand(
    name: 'lint:spdx',
    description: 'Apply SPDX linters to source and documentation files',
)]
final class LintSpdxCommand extends Command
{
    public const array HEADERS = [
        'License-Identifier: MIT',
        'FileCopyrightText: (c) Respect Project Contributors',
    ];
    public const array EXTENSIONS = [
        'php' => '/\/\*+(.*?)\*\//s',
        'md' => '/<!--+(.*?)-->/s',
    ];
    public const array SEARCH_DIRS = [
        '/src',
        '/src-dev',
        '/tests',
        '/bin',
        '/docs',
    ];

    public static function extractFileHeader(SplFileInfo $file): string
    {
        preg_match(
            self::EXTENSIONS[$file->getExtension()],
            file_get_contents($file->getRealPath()),
            $matches,
        );

        return $matches[1] ?? '';
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $pass = true;
        $root = dirname(__DIR__, 2);
        $finder = (new Finder())->in(array_map(static fn($dir) => $root . $dir, self::SEARCH_DIRS))->files();
        $validator = ValidatorBuilder::after(
            static fn($input) => array_filter(explode("\n", trim($input))),
            ValidatorBuilder::templated(
                'Each header line of {{subject}}',
                ValidatorBuilder::each(ValidatorBuilder::stringType()->contains('SPDX')),
            ),
        );

        foreach (array_keys(self::EXTENSIONS) as $extension) {
            $finder = $finder->name('*.' . $extension);
        }

        foreach (self::HEADERS as $headerLine) {
            $validator = $validator->contains(sprintf('SPDX-%s', $headerLine));
        }

        foreach ($finder as $file) {
            try {
                ValidatorBuilder::named(
                    sprintf('File "%s" SPDX header', $file->getRelativePathname()),
                    $validator,
                )->assert(static::extractFileHeader($file));
            } catch (ValidationException $e) {
                $output->writeln($e->getFullMessage());
                $pass = false;
            }
        }

        return $pass ? Command::SUCCESS : Command::FAILURE;
    }
}

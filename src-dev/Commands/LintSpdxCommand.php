<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Commands;

use InvalidArgumentException;
use Respect\Dev\Differ\ConsoleDiffer;
use Respect\Dev\Differ\Item;
use Respect\Dev\Spdx\ContributorExtractor\GitBlameContributorExtractor;
use Respect\Dev\Spdx\ContributorExtractor\GitLogContributorExtractor;
use Respect\Dev\Spdx\ContributorExtractor\HeaderContributorExtractor;
use Respect\Dev\Spdx\ContributorExtractor\NormalizingContributorExtractor;
use Respect\Dev\Spdx\HeaderRebuilder\HtmlHeaderRebuilder;
use Respect\Dev\Spdx\HeaderRebuilder\PhpHeaderRebuilder;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

use function array_keys;
use function array_map;
use function basename;
use function count;
use function dirname;
use function file_get_contents;
use function file_put_contents;
use function is_file;
use function realpath;
use function sprintf;

#[AsCommand(
    name: 'lint:spdx',
    description: 'Apply SPDX linters to source and documentation files',
)]
final class LintSpdxCommand extends Command
{
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

    private readonly PhpHeaderRebuilder $phpHeaderRebuilder;

    private readonly HtmlHeaderRebuilder $htmlHeaderBuilder;

    private readonly GitLogContributorExtractor $gitLogContributorExtractor;

    private readonly GitBlameContributorExtractor $gitBlameContributorExtractor;

    public function __construct(
        private readonly ConsoleDiffer $differ,
    ) {
        parent::__construct();

        $this->htmlHeaderBuilder = new HtmlHeaderRebuilder();
        $this->phpHeaderRebuilder = new PhpHeaderRebuilder();
        $this->gitBlameContributorExtractor = new GitBlameContributorExtractor();
        $this->gitLogContributorExtractor = new GitLogContributorExtractor();
    }

    protected function configure(): void
    {
        $this->addArgument(
            'path',
            InputArgument::OPTIONAL,
            'File or directory to lint (defaults to the whole codebase).',
        );
        $this->addOption(
            'fix',
            null,
            InputOption::VALUE_NONE,
            'Automatically fix files with issues.',
        );
        $this->addOption(
            'contributions-strategy',
            null,
            InputOption::VALUE_REQUIRED,
            'Strategy to get contributors: "git-blame" (git blame) or "git-log" (git log --follow).',
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $root = dirname(__DIR__, 2);
        $path = $input->getArgument('path');
        $finder = $this->createFinder($root, $path);

        $contributionsStrategy = $input->getOption('contributions-strategy');
        $updatableFiles = [];

        foreach ($finder as $file) {
            $content = file_get_contents($file->getRealPath());

            $extractor = new NormalizingContributorExtractor(
                match ($contributionsStrategy) {
                    'git-blame' => $this->gitBlameContributorExtractor,
                    'git-log' => $this->gitLogContributorExtractor,
                    default => new HeaderContributorExtractor(self::EXTENSIONS[$file->getExtension()]),
                },
            );

            $contributors = $extractor->extract($file->getRealPath());

            $rebuilder = match ($file->getExtension()) {
                'php' => $this->phpHeaderRebuilder,
                default => $this->htmlHeaderBuilder,
            };

            $fixedContent = $rebuilder->rebuild($content, $contributors);
            if ($content === $fixedContent) {
                continue;
            }

            $diff = $this->differ->diff(
                new Item($file->getRealPath(), $content),
                new Item($file->getRealPath(), $fixedContent),
            );

            if ($diff === null) {
                continue;
            }

            $output->writeln($diff);
            $updatableFiles[$file->getRealPath()] = $fixedContent;
        }

        if ($updatableFiles === []) {
            $output->writeln('<info>No changes needed.</info>');
        } else {
            $output->writeln(sprintf('<comment>Changes needed in %d files.</comment>', count($updatableFiles)));
        }

        if ($updatableFiles !== [] && !$input->getOption('fix')) {
            return Command::FAILURE;
        }

        foreach ($updatableFiles as $filepath => $content) {
            file_put_contents($filepath, $content);
        }

        return Command::SUCCESS;
    }

    private function createFinder(string $root, string|null $path): Finder
    {
        $finder = new Finder();

        if ($path !== null) {
            $realPath = realpath($path);
            if ($realPath === false) {
                throw new InvalidArgumentException(sprintf('Path "%s" does not exist.', $path));
            }

            if (is_file($realPath)) {
                return $finder->in(dirname($realPath))->name(basename($realPath))->files();
            }

            return $finder->in($realPath)->name('*.php')->name('*.md')->files();
        }

        $finder = $finder->in(array_map(static fn($dir) => $root . $dir, self::SEARCH_DIRS))->files();
        foreach (array_keys(self::EXTENSIONS) as $extension) {
            $finder = $finder->name('*.' . $extension);
        }

        return $finder;
    }
}

<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Dev\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use function array_unique;
use function basename;
use function count;
use function dirname;
use function file_exists;
use function file_get_contents;
use function file_put_contents;
use function glob;
use function implode;
use function in_array;
use function preg_match;
use function preg_match_all;
use function preg_split;
use function sort;
use function sprintf;
use function trim;

use const PHP_EOL;

#[AsCommand(
    name: 'update:doc-links',
    description: 'Update list of validators and link related validators in documentation',
)]
final class UpdateDocLinksCommand extends Command
{
    /** @var array<string, array<string>> */
    private array $validatorsByCategory = [];

    /** @var array<string, array<string>> */
    private array $relatedRules = [];

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $docsDirectory = dirname(__DIR__, 2) . '/docs';

        if (!file_exists($docsDirectory)) {
            $io->error(sprintf('Documentation directory not found: %s', $docsDirectory));

            return Command::FAILURE;
        }

        $validators = $this->listRules($docsDirectory);
        $this->createListOfRules($docsDirectory, $validators);
        $this->linkRelatedRules($docsDirectory, $validators, $io);
        $io->success('Documentation updated successfully');

        return Command::SUCCESS;
    }

    /** @return array<string> */
    private function listRules(string $docsDirectory): array
    {
        $files = glob($docsDirectory . '/validators/*.md');
        if ($files === false) {
            return [];
        }

        $validators = [];
        foreach ($files as $file) {
            $validators[] = basename($file, '.md');
        }

        sort($validators);

        return $validators;
    }

    /**
     * @param array<string> $validators
     *
     * @return array<string>
     */
    private function listCategories(string $docsDirectory, array $validators): array
    {
        $categories = [];

        foreach ($validators as $validator) {
            $filename = sprintf('%s/validators/%s.md', $docsDirectory, $validator);
            $content = file_get_contents($filename);
            if ($content === false) {
                continue;
            }

            // Extract categories between "## Categorization" and "## Changelog"
            if (!preg_match('/## Categorization\s*(.*?)\s*## Changelog/s', $content, $matches)) {
                continue;
            }

            preg_match_all('/^-\s*(.+)$/m', $matches[1], $categoryMatches);
            foreach ($categoryMatches[1] as $category) {
                $categories[] = trim($category);
            }
        }

        $categories = array_unique($categories);
        sort($categories);

        return $categories;
    }

    /** @param array<string> $validators */
    private function createListOfRules(string $docsDirectory, array $validators): void
    {
        // Build validators by category
        foreach ($validators as $validator) {
            $filename = sprintf('%s/validators/%s.md', $docsDirectory, $validator);
            $content = file_get_contents($filename);
            if ($content === false) {
                continue;
            }

            if (!preg_match('/## Categorization\s*(.*?)\s*## Changelog/s', $content, $matches)) {
                continue;
            }

            preg_match_all('/^-\s*(.+)$/m', $matches[1], $categoryMatches);
            foreach ($categoryMatches[1] as $category) {
                $category = trim($category);
                if (!isset($this->validatorsByCategory[$category])) {
                    $this->validatorsByCategory[$category] = [];
                }

                $this->validatorsByCategory[$category][] = $validator;
            }
        }

        // Generate the list file
        $categories = $this->listCategories($docsDirectory, $validators);
        $lines = ['# List of validators by category', ''];

        foreach ($categories as $category) {
            $lines[] = sprintf('## %s', $category);
            $lines[] = '';

            if (isset($this->validatorsByCategory[$category])) {
                $categoryRules = $this->validatorsByCategory[$category];
                sort($categoryRules);
                foreach ($categoryRules as $validator) {
                    $lines[] = sprintf('- [%s](validators/%s.md)', $validator, $validator);
                }
            }

            $lines[] = '';
        }

        $lines[] = '## Alphabetically';
        $lines[] = '';
        foreach ($validators as $validator) {
            $lines[] = sprintf('- [%1$s](validators/%1$s.md)', $validator);
        }

        $outputFile = sprintf('%s/09-list-of-validators-by-category.md', $docsDirectory);
        file_put_contents($outputFile, trim(implode("\n", $lines)) . PHP_EOL);
    }

    /** @param array<string> $validators */
    private function linkRelatedRules(string $docsDirectory, array $validators, SymfonyStyle $io): void
    {
        // Build list of related validators
        foreach ($validators as $validator) {
            $filename = sprintf('%s/validators/%s.md', $docsDirectory, $validator);
            $content = file_get_contents($filename);
            if ($content === false) {
                continue;
            }

            // Find all markdown links
            preg_match_all('/\[([^\]]+)\]\(([^\)]+)\.md\)/', $content, $matches);
            foreach ($matches[2] as $relatedRule) {
                $relatedRule = basename($relatedRule);
                if ($relatedRule === '08-comparable-values' || $relatedRule === 'comparing-empty-values') {
                    continue;
                }

                if (!isset($this->relatedRules[$relatedRule])) {
                    $this->relatedRules[$relatedRule] = [];
                }

                if (!in_array($validator, $this->relatedRules[$relatedRule], true)) {
                    $this->relatedRules[$relatedRule][] = $validator;
                }

                if (!isset($this->relatedRules[$validator])) {
                    $this->relatedRules[$validator] = [];
                }

                if (in_array($relatedRule, $this->relatedRules[$validator], true)) {
                    continue;
                }

                $this->relatedRules[$validator][] = $relatedRule;
            }
        }

        // Update each validator documentation
        $io->progressStart(count($validators));
        foreach ($validators as $validator) {
            $this->createRuleDocumentation($docsDirectory, $validator);
            $io->progressAdvance();
        }

        $io->progressFinish();
    }

    private function createRuleDocumentation(string $docsDirectory, string $validator): void
    {
        $filename = sprintf('%s/validators/%s.md', $docsDirectory, $validator);
        $content = file_get_contents($filename);
        if ($content === false) {
            return;
        }

        // Extract links at the bottom
        preg_match_all('/^\[.+\]: .+$/m', $content, $linkMatches);
        $links = $linkMatches[0] ?? [];

        // Get content before "See also" or "---"
        $parts = preg_split('/(^## See also:|^---)/m', $content);
        $mainContent = $parts[0] ?? $content;

        // Build "See also" section
        $relatedLinks = [];
        if (isset($this->relatedRules[$validator])) {
            $related = array_unique($this->relatedRules[$validator]);
            sort($related);
            foreach ($related as $relatedRule) {
                if ($relatedRule === $validator) {
                    continue;
                }

                $relatedLinks[] = sprintf('- [%s](%s.md)', $relatedRule, $relatedRule);
            }
        }

        // Rebuild the document
        $lines = [
            trim($mainContent),
            '',
            '---',
            '',
        ];

        if ($relatedLinks !== []) {
            $lines[] = 'See also:';
            $lines[] = '';
            $lines = [...$lines, ...$relatedLinks];
        }

        if ($links !== []) {
            $lines[] = '';
            $lines = [...$lines, ...$links];
        }

        file_put_contents($filename, trim(implode("\n", $lines)) . PHP_EOL);
    }
}

<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Dev\Markdown\Linters;

use Respect\Dev\Markdown\Content;
use Respect\Dev\Markdown\File;
use Respect\Dev\Markdown\Linter;
use Symfony\Component\Finder\Finder;

use function array_keys;
use function dirname;
use function ksort;
use function sort;
use function sprintf;
use function str_ends_with;
use function str_starts_with;
use function substr;
use function trim;

final readonly class ValidatorIndexLinter implements Linter
{
    public function lint(File $file): File
    {
        if (!str_ends_with($file->filename, '/validators/index.md')) {
            return $file;
        }

        $validators = $this->getSortedListOfValidators();

        $validatorsByCategory = [];
        foreach ($validators as $validator) {
            foreach ($this->getCategoriesByValidator($validator) as $category) {
                $validatorsByCategory[$category] ??= [];
                $validatorsByCategory[$category][] = $validator;
            }
        }

        ksort($validatorsByCategory);
        $validatorsByCategory['Alphabetically'] = $validators;

        $categories = array_keys($validatorsByCategory);

        $content = new Content();
        $content->h1('Overviews');
        $content->paragraph('In this page you will find a list of validators by their category.');
        $content->emptyLine();

        foreach ($categories as $category) {
            $content->h2($category);
            $categoryValidators = $validatorsByCategory[$category];
            sort($categoryValidators);
            foreach ($categoryValidators as $categoryValidator) {
                $content->anchorListItem($categoryValidator, sprintf('validators/%1$s.md', $categoryValidator));
            }

            $content->emptyLine();
        }

        return $file->withContent($content);
    }

    /** @return array<string> */
    private function getSortedListOfValidators(): array
    {
        $finder = new Finder();
        $finder
            ->in(dirname(__DIR__, 2) . '/../docs/validators')
            ->files()
            ->name('*.md')
            ->notName('index.md')
            ->sortByName();

        $validators = [];
        foreach ($finder as $file) {
            $validators[] = $file->getBasename('.md');
        }

        return $validators;
    }

    /** @return array<string> */
    private function getCategoriesByValidator(string $validator): array
    {
        $content = Content::from(sprintf('%s/validators/%s.md', dirname(__DIR__, 2) . '/../docs', $validator));
        $section = $content->getSection('## Categorization');

        $categories = [];
        foreach ($section as $line) {
            if (!str_starts_with($line, '-')) {
                continue;
            }

            $categories[] = trim(substr($line, 1));
        }

        return $categories;
    }
}

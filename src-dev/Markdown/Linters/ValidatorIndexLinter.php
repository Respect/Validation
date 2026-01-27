<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Markdown\Linters;

use Respect\Dev\Markdown\Content;
use Respect\Dev\Markdown\File;
use Respect\Dev\Markdown\Linter;
use Symfony\Component\Finder\Finder;

use function array_keys;
use function dirname;
use function implode;
use function ksort;
use function preg_match;
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
        if (!str_ends_with($file->filename, '/validators.md')) {
            return $file;
        }

        $content = $file->content->extractSpdx();

        $validators = $this->getSortedListOfValidators();

        $validatorsByCategory = [];
        $validatorsDescriptions = [];
        $validatorsExamples = [];
        foreach ($validators as $validator) {
            $validatorInfo = $this->getValidatorInfo($validator);
            foreach ($validatorInfo['categories'] as $category) {
                $validatorsByCategory[$category] ??= [];
                $validatorsByCategory[$category][] = $validator;
                $validatorsDescriptions[$validator] = $validatorInfo['description'];
                $validatorsExamples[$validator] = $validatorInfo['example'];
            }
        }

        ksort($validatorsByCategory);

        $categories = array_keys($validatorsByCategory);

        $content->h1('Validators');
        $content->paragraph('In this page you will find a list of validators by their category.');
        $content->emptyLine();

        foreach ($categories as $category) {
            $categoryValidators = $validatorsByCategory[$category];
            sort($categoryValidators);
            $refs = [];
            foreach ($categoryValidators as $categoryValidator) {
                $refs[] = sprintf('[%s][]', $categoryValidator);
            }

            $content->paragraph(sprintf('**%s**: %s', $category, implode(' - ', $refs)));

            $content->emptyLine();
        }

        $content->h2('Alphabetically');
        foreach ($validators as $validator) {
            $content->listItem(sprintf('[%s][] - `%s`', $validator, $validatorsExamples[$validator]));
        }

        $content->emptyLine();

        foreach (array_keys($validatorsDescriptions) as $validator) {
            $content->reference(
                $validator,
                sprintf('validators/%s.md', $validator),
                $validatorsDescriptions[$validator],
            );
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
    private function getValidatorInfo(string $validator): array
    {
        $content = Content::from(sprintf('%s/validators/%s.md', dirname(__DIR__, 2) . '/../docs', $validator));
        $section = $content->getSection('## Categorization');
        $description = '';
        $example = '';
        foreach ($content->getSection(sprintf('# %s', $validator)) as $line) {
            if ($description === '' && preg_match('/^[A-Z]/', $line) === 1) {
                $description = $line;
            }

            if (preg_match('/^v::/', $line) === 1) {
                $example = $line;
                break;
            }
        }

        $categories = [];
        foreach ($section as $line) {
            if (!str_starts_with($line, '-')) {
                continue;
            }

            $categories[] = trim(substr($line, 1));
        }

        return [
            'categories' => $categories,
            'description' => Content::stripRefs($description),
            'example' => $example,
        ];
    }
}

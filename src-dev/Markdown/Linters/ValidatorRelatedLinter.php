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

use function array_keys;
use function array_unique;
use function basename;
use function dirname;
use function file_get_contents;
use function in_array;
use function preg_match_all;
use function sort;
use function sprintf;
use function str_contains;

final readonly class ValidatorRelatedLinter implements Linter
{
    public function lint(File $file): File
    {
        if (!str_contains($file->filename, '/validators/')) {
            return $file;
        }

        $validator = basename($file->filename, '.md');
        $relatedValidators = $this->getRelatedValidators($validator);

        if ($relatedValidators === []) {
            return $file;
        }

        $content = new Content();
        $content->paragraph('See also:');
        $content->emptyLine();
        foreach ($relatedValidators as $relatedValidator) {
            $content->anchorListItem($relatedValidator, $relatedValidator . '.md');
        }

        $content->emptyLine();

        return $file->withContent($file->content->withSection($content));
    }

    /** @return array<string> */
    private function getRelatedValidators(string $validator): array
    {
        $docsDirectory = dirname(__DIR__, 3) . '/docs';
        $filename = sprintf('%s/validators/%s.md', $docsDirectory, $validator);
        $content = file_get_contents($filename);
        if ($content === false) {
            return [];
        }

        $relatedValidators = [];

        preg_match_all('/\[([^\]]+)\]\(([^\)]+\.md)\)/', $content, $matches);
        foreach (array_keys($matches[0]) as $key) {
            $related = $matches[1][$key];
            $document = $matches[2][$key];
            if (str_contains($document, '/') || in_array($related, $relatedValidators)) {
                continue;
            }

            $relatedValidators[] = $related;
        }

        $relatedValidators = array_unique($relatedValidators);
        sort($relatedValidators);

        return $relatedValidators;
    }
}

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
use UnexpectedValueException;

use function array_unique;
use function file_exists;
use function preg_match_all;
use function sort;
use function str_contains;

final readonly class ValidatorRelatedLinter implements Linter
{
    public function lint(File $file): File
    {
        if (!str_contains($file->filename, '/validators/')) {
            return $file;
        }

        $relatedValidators = $this->getRelatedValidators($file);

        if ($relatedValidators === []) {
            return $file;
        }

        $content = new Content();
        $content->h2('See Also');
        foreach ($relatedValidators as $relatedValidator) {
            if (!file_exists('docs/validators/' . $relatedValidator . '.md')) {
                continue;
            }

            $content->anchorListItem($relatedValidator, $relatedValidator . '.md');
        }

        $content->emptyLine();

        return $file->withContent($file->content->withSection($content));
    }

    /** @return array<string> */
    private function getRelatedValidators(File $validator): array
    {
        try {
            $seeAlso = $validator->content->getSection('## See Also');
        } catch (UnexpectedValueException) {
            return [];
        }

        $relatedValidators = [];
        $lines = $seeAlso->toArray();
        foreach ($lines as $line) {
            preg_match_all('/\[(.+?)\]\((.+?)\.md\)/', $line, $matches);
            foreach ($matches[1] as $match) {
                $relatedValidators[] = $match;
            }
        }

        $relatedValidators = array_unique($relatedValidators);
        sort($relatedValidators);

        return $relatedValidators;
    }
}

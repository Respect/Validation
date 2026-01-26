<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 */

declare(strict_types=1);

namespace Respect\Dev\Markdown\Linters;

use Respect\Dev\Markdown\Content;
use Respect\Dev\Markdown\File;
use Respect\Dev\Markdown\Linter;
use UnexpectedValueException;

use function count;
use function explode;
use function is_numeric;
use function str_contains;
use function str_replace;
use function trim;

final readonly class ValidatorChangelogLinter implements Linter
{
    public function lint(File $file): File
    {
        if (!str_contains($file->filename, '/validators/')) {
            return $file;
        }

        $changeLogItems = $this->getChangelogItems($file);

        $content = new Content();
        $content->h2('Changelog');
        $content->table(['Version', 'Description'], $changeLogItems, alignment: [1, -1]);

        return $file->withContent($file->content->withSection($content));
    }

    /** @return array<int, array<int, string>> */
    private function getChangelogItems(File $validator): array
    {
        try {
            $changeLog = $validator->content->getSection('## Changelog');
        } catch (UnexpectedValueException) {
            return [];
        }

        $changeLogEntries = [];
        foreach ($changeLog->toArray() as $line) {
            $lineParts = explode('|', $line);
            if (count($lineParts) < 3) {
                continue;
            }

            if (!is_numeric(str_replace('.', '', trim($lineParts[1])))) {
                continue;
            }

            $changeLogEntries[] = [trim($lineParts[1]), trim($lineParts[2])];
        }

        return $changeLogEntries;
    }
}

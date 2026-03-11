<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\CodeGen;

use function array_keys;
use function array_values;
use function implode;
use function preg_match;
use function preg_replace;
use function trim;

use const PHP_EOL;

final class OutputFormatter
{
    public function format(string $content, string $existingContent): string
    {
        preg_match('/^<\?php\s*\/\*[\s\S]*?\*\//', $existingContent, $matches);
        $existingHeader = $matches[0] ?? '';

        $replacements = [
            '/\n\n\t(public|private|\/\*\*)/m' => PHP_EOL . '    $1',
            '/\t/m' => '    ',
            '/\?([a-zA-Z]+) \$/' => '$1|null $',
            '/\/\*\*\n +\* (.+)\n +\*\//m' => '/** $1 */',
        ];

        return implode(PHP_EOL, [
            trim($existingHeader) . PHP_EOL,
            'declare(strict_types=1);',
            '',
            preg_replace(
                array_keys($replacements),
                array_values($replacements),
                $content,
            ),
        ]);
    }
}

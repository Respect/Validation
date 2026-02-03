<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Spdx\HeaderRebuilder;

use Respect\Dev\Spdx\Contributor;

use function implode;
use function preg_match;
use function preg_replace;
use function sprintf;

use const PHP_EOL;

final class PhpHeaderRebuilder implements HeaderRebuilder
{
    private const string SPDX_HEADER_PATTERN = '/(\/\*\n)( \* SPDX-[^\n]+\n)+( \*\/)/';

    /** @param array<Contributor> $contributors */
    public function rebuild(string $content, array $contributors): string
    {
        // REUSE-IgnoreStart
        $spdxLines = [
            ' * SPDX-License-Identifier: MIT',
            ' * SPDX-FileCopyrightText: (c) Respect Project Contributors',
        ];

        foreach ($contributors as $contributor) {
            if ($contributor->email === null) {
                $spdxLines[] = sprintf(' * SPDX-FileContributor: %s', $contributor->name);
                continue;
            }

            $spdxLines[] = sprintf(' * SPDX-FileContributor: %s <%s>', $contributor->name, $contributor->email);
        }

        // REUSE-IgnoreEnd

        $newSpdxBlock = implode(PHP_EOL, $spdxLines);

        // If header exists, replace it
        if (preg_match(self::SPDX_HEADER_PATTERN, $content) === 1) {
            return preg_replace(
                self::SPDX_HEADER_PATTERN,
                '$1' . $newSpdxBlock . PHP_EOL . '$3',
                $content,
            );
        }

        // Otherwise, add header after <?php
        $header = '/*' . PHP_EOL . $newSpdxBlock . PHP_EOL . ' */' . PHP_EOL;

        return preg_replace(
            '/^<\?php\n/',
            '<?php' . PHP_EOL . PHP_EOL . $header,
            $content,
        );
    }
}

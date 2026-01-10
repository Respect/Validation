<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Helpers;

use RuntimeException;
use Symfony\Component\VarExporter\VarExporter;

use function array_is_list;
use function dirname;
use function file_put_contents;
use function implode;
use function ksort;
use function preg_replace;
use function str_replace;

use const DIRECTORY_SEPARATOR;
use const PHP_EOL;

final class DataSaver
{
    /** @param array<string|int, mixed> $data */
    public function save(array $data, string $fileCopyrightText, string $licenseIdentifier, string $path): void
    {
        if (!array_is_list($data)) {
            ksort($data);
        }

        $fileContent = implode(PHP_EOL, [
            // REUSE-IgnoreStart
            '<?php declare(strict_types=1);',
            '// SPDX-FileCopyrightText: ' . $fileCopyrightText,
            '// SPDX-License-Identifier: ' . $licenseIdentifier,
            // REUSE-IgnoreEnd
            'return ' . preg_replace('/\\\([dws])/', '\\1', VarExporter::export($data)) . ';' . PHP_EOL,
        ]);

        $filename = str_replace('/', DIRECTORY_SEPARATOR, dirname(__DIR__, 2) . '/data/' . $path);
        if (file_put_contents($filename, $fileContent) === false) {
            throw new RuntimeException('Failed to write data file: ' . $filename);
        }
    }
}

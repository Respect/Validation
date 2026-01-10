<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use function dirname;
use function file_exists;
use function str_replace;

use const DIRECTORY_SEPARATOR;

final class DataLoader
{
    /** @var array<string, array<int|string, mixed>> */
    private static array $runtimeCache = [];

    /** @return array<string|int, mixed> */
    public static function load(string $basePath): array
    {
        $basePath = str_replace('/', DIRECTORY_SEPARATOR, $basePath);
        $path = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $basePath;
        if (!isset(static::$runtimeCache[$basePath])) {
            static::$runtimeCache[$basePath] = file_exists($path) ? require $path : [];
        }

        return static::$runtimeCache[$basePath];
    }
}

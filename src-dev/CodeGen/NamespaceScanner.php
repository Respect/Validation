<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\CodeGen;

use DirectoryIterator;
use ReflectionClass;

use function ksort;

final class NamespaceScanner
{
    /** @return array<string, ReflectionClass> */
    public static function scan(string $directory, string $namespace): array
    {
        $nodes = [];

        foreach (new DirectoryIterator($directory) as $file) {
            if (!$file->isFile()) {
                continue;
            }

            $className = $namespace . '\\' . $file->getBasename('.php');
            $reflection = new ReflectionClass($className);

            if ($reflection->isAbstract()) {
                continue;
            }

            $nodes[$reflection->getShortName()] = $reflection;
        }

        ksort($nodes);

        return $nodes;
    }
}

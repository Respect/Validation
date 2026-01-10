<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

#[CoversClass(DataLoader::class)]
final class DataLoaderTest extends TestCase
{
    protected function setUp(): void
    {
        // Clear the runtime cache before each test
        $reflection = new ReflectionClass(DataLoader::class);
        $property = $reflection->getProperty('runtimeCache');
        $property->setValue(null, []);
    }

    #[Test]
    public function shouldLoadDataWhenExistingFileIsProvided(): void
    {
        $data = DataLoader::load('postal-code.php');

        self::assertNotEmpty($data);
    }

    #[Test]
    public function shouldReturnEmptyArrayWhenNonExistingFileIsProvided(): void
    {
        $data = DataLoader::load('non-existing-file.php');

        self::assertEmpty($data);
    }

    #[Test]
    public function shouldLoadDataWhenSubdirectoryPathIsProvided(): void
    {
        $data = DataLoader::load('domain/tld.php');

        self::assertNotEmpty($data);
    }

    #[Test]
    public function shouldReturnDifferentDataWhenDifferentFilesAreLoaded(): void
    {
        $data1 = DataLoader::load('postal-code.php');
        $data2 = DataLoader::load('domain/tld.php');

        self::assertNotSame($data1, $data2);
    }
}

<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Inference;

use PHPStan\Testing\TypeInferenceTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

final class NarrowingTest extends TypeInferenceTestCase
{
    /** @return list<string> */
    public static function getAdditionalConfigFiles(): array
    {
        return [
            __DIR__ . '/../../vendor/respect/fluent-analysis/extension.neon',
            __DIR__ . '/../../fluent.neon',
        ];
    }

    /** @return iterable<mixed> */
    public static function dataFileAsserts(): iterable
    {
        yield from self::gatherAssertTypes(__DIR__ . '/assertions/narrowing.php');
    }

    #[Test]
    #[DataProvider('dataFileAsserts')]
    public function fileAsserts(string $assertType, string $file, mixed ...$args): void
    {
        $this->assertFileAsserts($assertType, $file, ...$args);
    }
}

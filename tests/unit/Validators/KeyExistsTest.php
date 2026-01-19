<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[CoversClass(KeyExists::class)]
final class KeyExistsTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonArrayValues')]
    public function itShouldAlwaysInvalidateNonArrayValues(mixed $input): void
    {
        $validator = new KeyExists(0);

        self::assertInvalidInput($validator, $input);
    }

    /** @param array<mixed> $input  */
    #[Test]
    #[DataProvider('providerForArrayWithMissingKeys')]
    public function itShouldInvalidateMissingKeys(int|string $key, array $input): void
    {
        $validator = new KeyExists($key);

        self::assertInvalidInput($validator, $input);
    }

    /** @param array<mixed> $input  */
    #[Test]
    #[DataProvider('providerForArrayWithExistingKeys')]
    public function itShouldValidateExistingKeys(int|string $key, array $input): void
    {
        $validator = new KeyExists($key);

        self::assertValidInput($validator, $input);
    }
}

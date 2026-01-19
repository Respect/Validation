<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;

#[Group('validator')]
#[CoversClass(Key::class)]
final class KeyTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonArrayValues')]
    public function itShouldAlwaysInvalidateNonArrayValues(mixed $input): void
    {
        $validator = new Key(0, Stub::daze());

        self::assertInvalidInput($validator, $input);
    }

    /** @param array<mixed> $input  */
    #[Test]
    #[DataProvider('providerForArrayWithMissingKeys')]
    public function itShouldInvalidateMissingKeys(int|string $key, array $input): void
    {
        $validator = new Key($key, Stub::daze());

        self::assertInvalidInput($validator, $input);
    }

    /** @param array<mixed> $input  */
    #[Test]
    #[DataProvider('providerForArrayWithExistingKeys')]
    public function itShouldValidateExistingKeysWithWrappedRule(int|string $key, array $input): void
    {
        $wrapped = Stub::pass(1);

        $validator = new Key($key, $wrapped);
        $validator->evaluate($input);

        self::assertEquals($wrapped->inputs, [$input[$key]]);
    }

    #[Test]
    public function itShouldReturnDefinedKey(): void
    {
        $key = 'toodaloo';
        $validator = new Key($key, Stub::daze());

        self::assertSame($key, $validator->getKey());
    }
}

<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
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
#[CoversClass(KeyOptional::class)]
final class KeyOptionalTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonArrayValues')]
    public function itShouldAlwaysValidateNonArrayValues(mixed $input): void
    {
        $validator = new KeyOptional(0, Stub::daze());

        self::assertValidInput($validator, $input);
    }

    /** @param array<mixed> $input  */
    #[Test]
    #[DataProvider('providerForArrayWithMissingKeys')]
    public function itShouldAlwaysValidateMissingKeys(int|string $key, array $input): void
    {
        $validator = new KeyOptional($key, Stub::daze());

        self::assertValidInput($validator, $input);
    }

    /** @param array<mixed> $input  */
    #[Test]
    #[DataProvider('providerForArrayWithExistingKeys')]
    public function itShouldValidateExistingKeysWithWrappedRule(int|string $key, array $input): void
    {
        $wrapped = Stub::pass(1);

        $validator = new KeyOptional($key, $wrapped);
        $validator->evaluate($input);

        self::assertEquals($wrapped->inputs, [$input[$key]]);
    }
}

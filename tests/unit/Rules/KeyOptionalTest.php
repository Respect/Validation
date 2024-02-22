<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;

#[Group('rule')]
#[CoversClass(KeyOptional::class)]
final class KeyOptionalTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonArrayValues')]
    public function itShouldAlwaysValidateNonArrayValues(mixed $input): void
    {
        $rule = new KeyOptional(0, Stub::daze());

        self::assertValidInput($rule, $input);
    }

    /** @param array<mixed> $input  */
    #[Test]
    #[DataProvider('providerForArrayWithMissingKeys')]
    public function itShouldAlwaysValidateMissingKeys(int|string $key, array $input): void
    {
        $rule = new KeyOptional($key, Stub::daze());

        self::assertValidInput($rule, $input);
    }

    /** @param array<mixed> $input  */
    #[Test]
    #[DataProvider('providerForArrayWithExistingKeys')]
    public function itShouldValidateExistingKeysWithWrappedRule(int|string $key, array $input): void
    {
        $wrapped = Stub::pass(1);

        $rule = new KeyOptional($key, $wrapped);
        $rule->evaluate($input);

        self::assertEquals($wrapped->inputs, [$input[$key]]);
    }

    #[Test]
    public function itShouldUpdateWrappedNameWithTheGivenKeyWhenItIsString(): void
    {
        $key = 'toodaloo';

        $wrapped = Stub::daze();

        new KeyOptional($key, $wrapped);

        self::assertEquals($key, $wrapped->getName());
    }

    #[Test]
    public function itShouldUpdateWrappedNameWithTheGivenKeyWhenItIsInteger(): void
    {
        $key = 123;

        $wrapped = Stub::daze();

        new KeyOptional($key, $wrapped);

        self::assertEquals($key, $wrapped->getName());
    }
}

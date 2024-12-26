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
#[CoversClass(Key::class)]
final class KeyTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonArrayValues')]
    public function itShouldAlwaysInvalidateNonArrayValues(mixed $input): void
    {
        $rule = new Key(0, Stub::daze());

        self::assertInvalidInput($rule, $input);
    }

    /** @param array<mixed> $input  */
    #[Test]
    #[DataProvider('providerForArrayWithMissingKeys')]
    public function itShouldInvalidateMissingKeys(int|string $key, array $input): void
    {
        $rule = new Key($key, Stub::daze());

        self::assertInvalidInput($rule, $input);
    }

    /** @param array<mixed> $input  */
    #[Test]
    #[DataProvider('providerForArrayWithExistingKeys')]
    public function itShouldValidateExistingKeysWithWrappedRule(int|string $key, array $input): void
    {
        $wrapped = Stub::pass(1);

        $rule = new Key($key, $wrapped);
        $rule->evaluate($input);

        self::assertEquals($wrapped->inputs, [$input[$key]]);
    }

    #[Test]
    public function itShouldReturnDefinedKey(): void
    {
        $key = 'toodaloo';
        $rule = new Key($key, Stub::daze());

        self::assertSame($key, $rule->getKey());
    }
}

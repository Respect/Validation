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
use Respect\Validation\Test\DataProvider as RespectDataProvider;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;

use function count;
use function mb_strlen;

#[Group('rule')]
#[CoversClass(Length::class)]
final class LengthTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonStringsNorCountable')]
    public function itShouldAlwaysInvalidateNonStringsNorCountable(mixed $input): void
    {
        self::assertInvalidInput(new Length(Stub::any(1)), $input);
    }

    #[Test]
    #[DataProvider('providerForStringTypes')]
    public function itShouldValidateStringTypes(string $input): void
    {
        $wrapped = Stub::pass(1);
        $rule = new Length($wrapped);

        self::assertValidInput($rule, $input);
        self::assertEquals(mb_strlen($input), $wrapped->inputs[0]);
    }

    #[Test]
    #[DataProvider('providerForCountable')]
    public function itShouldValidateCountable(mixed $input): void
    {
        $wrapped = Stub::pass(1);
        $rule = new Length($wrapped);

        self::assertValidInput($rule, $input);
        self::assertEquals(count($input), $wrapped->inputs[0]);
    }

    public static function providerForNonStringsNorCountable(): RespectDataProvider
    {
        return self::providerForAnyValues()->without('stringType', 'countable');
    }
}

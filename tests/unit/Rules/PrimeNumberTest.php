<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(PrimeNumber::class)]
final class PrimeNumberTest extends RuleTestCase
{
    /** @return iterable<array{PrimeNumber, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new PrimeNumber();

        return [
            [$rule, 3],
            [$rule, 5],
            [$rule, 7],
            [$rule, '3'],
            [$rule, '5'],
            [$rule, '+7'],
        ];
    }

    /** @return iterable<array{PrimeNumber, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new PrimeNumber();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 0],
            [$rule, 10],
            [$rule, 25],
            [$rule, 36],
            [$rule, -1],
            [$rule, '-1'],
            [$rule, '25'],
            [$rule, '0'],
            [$rule, 'a'],
            [$rule, ' '],
            [$rule, 'Foo'],
        ];
    }
}

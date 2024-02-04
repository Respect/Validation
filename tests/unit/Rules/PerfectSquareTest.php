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
#[CoversClass(PerfectSquare::class)]
final class PerfectSquareTest extends RuleTestCase
{
    /** @return iterable<array{PerfectSquare, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new PerfectSquare();

        return [
            [$rule, 1],
            [$rule, 9],
            [$rule, 25],
            [$rule, '25'],
            [$rule, 400],
            [$rule, '400'],
            [$rule, '0'],
            [$rule, 81],
            [$rule, 0],
            [$rule, 2500],
        ];
    }

    /** @return iterable<array{PerfectSquare, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new PerfectSquare();

        return [
            [$rule, 250],
            [$rule, ''],
            [$rule, null],
            [$rule, 7],
            [$rule, -1],
            [$rule, 6],
            [$rule, 2],
            [$rule, '-1'],
            [$rule, 'a'],
            [$rule, ' '],
            [$rule, 'Foo'],
        ];
    }
}

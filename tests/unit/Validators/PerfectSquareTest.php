<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(PerfectSquare::class)]
final class PerfectSquareTest extends RuleTestCase
{
    /** @return iterable<array{PerfectSquare, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new PerfectSquare();

        return [
            [$validator, 1],
            [$validator, 9],
            [$validator, 25],
            [$validator, '25'],
            [$validator, 400],
            [$validator, '400'],
            [$validator, '0'],
            [$validator, 81],
            [$validator, 0],
            [$validator, 2500],
        ];
    }

    /** @return iterable<array{PerfectSquare, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new PerfectSquare();

        return [
            [$validator, 250],
            [$validator, ''],
            [$validator, null],
            [$validator, 7],
            [$validator, -1],
            [$validator, 6],
            [$validator, 2],
            [$validator, '-1'],
            [$validator, 'a'],
            [$validator, ' '],
            [$validator, 'Foo'],
        ];
    }
}

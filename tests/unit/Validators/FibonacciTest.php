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
#[CoversClass(Fibonacci::class)]
final class FibonacciTest extends RuleTestCase
{
    /** @return iterable<array{Fibonacci, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Fibonacci();

        return [
            [$validator, 1],
            [$validator, 2],
            [$validator, 3],
            [$validator, 5],
            [$validator, 8.0],
            [$validator, '3'],
            [$validator, 21],
            [$validator, 21.0],
            [$validator, '21.0'],
            [$validator, 34],
            [$validator, '34'],
            [$validator, 1346269],
            [$validator, 10610209857723],
        ];
    }

    /** @return iterable<array{Fibonacci, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Fibonacci();

        return [
            [$validator, 0],
            [$validator, 1346268],
            [$validator, ''],
            [$validator, null],
            [$validator, 7],
            [$validator, -1],
            [$validator, 5.2],
            [$validator, '-1'],
            [$validator, 'a'],
            [$validator, ' '],
            [$validator, false],
            [$validator, true],
        ];
    }
}

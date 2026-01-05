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

#[Group('validator')]
#[CoversClass(PrimeNumber::class)]
final class PrimeNumberTest extends RuleTestCase
{
    /** @return iterable<array{PrimeNumber, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new PrimeNumber();

        return [
            [$validator, 3],
            [$validator, 5],
            [$validator, 7],
            [$validator, '3'],
            [$validator, '5'],
            [$validator, '+7'],
        ];
    }

    /** @return iterable<array{PrimeNumber, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new PrimeNumber();

        return [
            [$validator, ''],
            [$validator, null],
            [$validator, 0],
            [$validator, 10],
            [$validator, 25],
            [$validator, 36],
            [$validator, -1],
            [$validator, '-1'],
            [$validator, '25'],
            [$validator, '0'],
            [$validator, 'a'],
            [$validator, ' '],
            [$validator, 'Foo'],
        ];
    }
}

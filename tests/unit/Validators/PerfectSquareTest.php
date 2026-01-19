<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Kleber Hamada Sato <kleberhs007@yahoo.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
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

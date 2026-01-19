<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Ismael Elias <ismael.esq@hotmail.com>
 * SPDX-FileContributor: Kleber Hamada Sato <kleberhs007@yahoo.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

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

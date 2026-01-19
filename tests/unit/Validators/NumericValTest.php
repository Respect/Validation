<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Augusto Pascutti <augusto.hp@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(NumericVal::class)]
final class NumericValTest extends RuleTestCase
{
    /** @return iterable<array{NumericVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $numericVal = new NumericVal();

        return [
            [$numericVal, 164],
            [$numericVal, 165.0],
            [$numericVal, -165],
            [$numericVal, '165'],
            [$numericVal, '165.0'],
            [$numericVal, '+165.0'],
        ];
    }

    /** @return iterable<array{NumericVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $numericVal = new NumericVal();

        return [
            [$numericVal, ''],
            [$numericVal, null],
            [$numericVal, 'a'],
            [$numericVal, ' '],
            [$numericVal, 'Foo'],
        ];
    }
}

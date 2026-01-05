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

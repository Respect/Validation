<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\NumericVal
 */
final class NumericValTest extends RuleTestCase
{
    /**
     * @return array<array{NumericVal, mixed}>
     */
    public static function providerForValidInput(): array
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

    /**
     * @return array<array{NumericVal, mixed}>
     */
    public static function providerForInvalidInput(): array
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

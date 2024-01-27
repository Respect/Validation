<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime;
use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\LeapYear
 */
final class LeapYearTest extends RuleTestCase
{
    /**
     * @return array<array{LeapYear, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new LeapYear();

        return [
            [$rule, '2008'],
            [$rule, '2008-02-29'],
            [$rule, 2008],
            [$rule, 2008],
            [$rule, new DateTime('2008-02-29')],
        ];
    }

    /**
     * @return array<array{LeapYear, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new LeapYear();

        return [
            [$rule, ''],
            [$rule, '2009'],
            [$rule, '2009-02-29'],
            [$rule, 2009],
            [$rule, new DateTime('2009-02-29')],
            [$rule, []],
        ];
    }
}

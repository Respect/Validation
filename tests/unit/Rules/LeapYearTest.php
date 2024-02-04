<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(LeapYear::class)]
final class LeapYearTest extends RuleTestCase
{
    /** @return iterable<array{LeapYear, mixed}> */
    public static function providerForValidInput(): iterable
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

    /** @return iterable<array{LeapYear, mixed}> */
    public static function providerForInvalidInput(): iterable
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

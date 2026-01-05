<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(LeapYear::class)]
final class LeapYearTest extends RuleTestCase
{
    /** @return iterable<array{LeapYear, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new LeapYear();

        return [
            [$validator, '2008'],
            [$validator, '2008-02-29'],
            [$validator, 2008],
            [$validator, 2008],
            [$validator, new DateTime('2008-02-29')],
        ];
    }

    /** @return iterable<array{LeapYear, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new LeapYear();

        return [
            [$validator, ''],
            [$validator, '2009'],
            [$validator, '2009-02-29'],
            [$validator, 2009],
            [$validator, new DateTime('2009-02-29')],
            [$validator, []],
        ];
    }
}

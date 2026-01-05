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

#[Group('validator')]
#[CoversClass(LeapDate::class)]
final class LeapDateTest extends RuleTestCase
{
    /** @return iterable<array{LeapDate, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new LeapDate('Y-m-d'), '1988-02-29'],
            [new LeapDate('Y-m-d'), '1992-02-29'],
            [new LeapDate('Y-m-d'), new DateTime('1988-02-29')],
            [new LeapDate('Y-m-d'), new DateTime('1992-02-29')],
        ];
    }

    /** @return iterable<array{LeapDate, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new LeapDate('Y-m-d'), '1989-02-29'],
            [new LeapDate('Y-m-d'), '1993-02-29'],
            [new LeapDate('Y-m-d'), new DateTime('1989-02-29')],
            [new LeapDate('Y-m-d'), new DateTime('1993-02-29')],
            [new LeapDate('Y-m-d'), []],
        ];
    }
}

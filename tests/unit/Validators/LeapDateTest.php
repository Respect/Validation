<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jayson Reis <santosdosreis@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use DateTime;
use DateTimeImmutable;
use Lcobucci\Clock\FrozenClock;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(LeapDate::class)]
final class LeapDateTest extends RuleTestCase
{
    #[Test]
    public function itShouldTakeTheYearTheFormatDoesNotAskForFromTheClock(): void
    {
        $inLeapYear = new LeapDate('m-d', new FrozenClock(new DateTimeImmutable('2024-06-01')));
        $inCommonYear = new LeapDate('m-d', new FrozenClock(new DateTimeImmutable('2023-06-01')));

        self::assertValidInput($inLeapYear, '02-29');
        self::assertInvalidInput($inCommonYear, '02-29');
    }

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

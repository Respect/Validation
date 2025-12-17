<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime as DateTimeMutable;
use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\RuleTestCase;

use function date_default_timezone_get;
use function date_default_timezone_set;

#[Group('rule')]
#[CoversClass(DateTime::class)]
final class DateTimeTest extends RuleTestCase
{
    #[Test]
    #[DataProvider('providerForDateTimeWithTimezone')]
    public function shouldValidateNoMatterTimezone(string $format, string $input, string $timezone): void
    {
        $currentTimezone = date_default_timezone_get();

        date_default_timezone_set($timezone);

        $rule = new DateTime($format);

        self::assertValidInput($rule, $input);

        date_default_timezone_set($currentTimezone);
    }

    /** @return mixed[][] */
    public static function providerForDateTimeWithTimezone(): array
    {
        return [
            ['c', '2004-02-12T15:19:21+00:00', 'Europe/Amsterdam'],
            ['c', '2004-02-12T15:19:21+00:00', 'UTC'],
            ['d/m/Y', '23/05/1987', 'Europe/Amsterdam'],
            ['d/m/Y', '23/05/1987', 'UTC'],
            ['r', 'Thu, 29 Dec 2005 01:02:03 +0000', 'Europe/Amsterdam'],
            ['r', 'Thu, 29 Dec 2005 01:02:03 +0000', 'UTC'],
            ['Ym', '202305', 'Europe/Amsterdam'],
            ['Ym', '202305', 'UTC'],
        ];
    }

    /** @return iterable<array{DateTime, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new DateTime(), 'now'],
            [new DateTime(), 'today'],
            [new DateTime(), 'tomorrow'],
            [new DateTime(), 'yesterday'],
            [new DateTime(), '+1 day'],
            [new DateTime(), 'next Thursday'],
            [new DateTime(), '+1 week 2 days 4 hours 2 seconds'],
            [new DateTime(), 2018],
            [new DateTime(), new DateTimeMutable()],
            [new DateTime(), new DateTimeImmutable()],
            [new DateTime('Y-m-d'), '2009-09-09'],
            [new DateTime('d/m/Y'), '23/05/1987'],
            [new DateTime('c'), '2004-02-12T15:19:21+00:00'],
            [new DateTime('r'), 'Thu, 29 Dec 2005 01:02:03 +0000'],
            [new DateTime('U'), 1464658596],
            [new DateTime('h'), 6],
            [new DateTime('Ym'), 202305],
            [new DateTime(DateTimeInterface::RFC3339), '2018-02-23T12:00:00+00:00'],
            [new DateTime(DateTimeInterface::RFC3339_EXTENDED), '2024-02-04T14:14:47.000+00:00'],
        ];
    }

    /** @return iterable<array{DateTime, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new DateTime(), 'not-a-date'],
            [new DateTime(), []],
            [new DateTime(), true],
            [new DateTime(), false],
            [new DateTime(), null],
            [new DateTime(), ''],
            [new DateTime('Y-m-d'), '2009-12-00'],
            [new DateTime('Y-m-d'), '2018-02-29'],
            [new DateTime('h'), 24],
            [new DateTime('c'), new DateTimeMutable()],
            [new DateTime('c'), new DateTimeImmutable()],
            [new DateTime('Y-m-d H:i:s'), '21-3-123:12:01'],
            [new DateTime(DateTimeInterface::RFC3339_EXTENDED), '2005-12-30T01:02:03Z'],
            [new DateTime(DateTimeInterface::RFC3339_EXTENDED), '1937-01-01T12:00:27.87+00:20'],
        ];
    }
}

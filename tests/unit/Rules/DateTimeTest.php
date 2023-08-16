<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime as DateTimeMutable;
use DateTimeImmutable;
use Respect\Validation\Test\RuleTestCase;

use function date_default_timezone_get;
use function date_default_timezone_set;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\DateTime
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Eduardo Reveles <me@osiux.ws>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author qrazi <qrazi.sivlingworkz@gmail.com>
 */
final class DateTimeTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
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
            [new DateTime('Ym'), 202302],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
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
        ];
    }

    /**
     * @test
     */
    public function shouldPassFormatToParameterToException(): void
    {
        $format = 'F jS, Y';
        $equals = new DateTime($format);
        $exception = $equals->reportError('input');

        self::assertSame($format, $exception->getParam('format'));
    }

    /**
     * @return mixed[][]
     */
    public function providerForDateTimeWithTimezone(): array
    {
        return [
            ['c', '2004-02-12T15:19:21+00:00', 'Europe/Amsterdam'],
            ['c', '2004-02-12T15:19:21+00:00', 'UTC'],
            ['d/m/Y', '23/05/1987', 'Europe/Amsterdam'],
            ['d/m/Y', '23/05/1987', 'UTC'],
            ['r', 'Thu, 29 Dec 2005 01:02:03 +0000', 'Europe/Amsterdam'],
            ['r', 'Thu, 29 Dec 2005 01:02:03 +0000', 'UTC'],
            ['Ym', '202302', 'Europe/Amsterdam'],
            ['Ym', '202302', 'UTC'],
        ];
    }

    /**
     * Datetime strings with timezone information are valid independent on the
     * system's timezone setting.
     *
     * @test
     *
     * @dataProvider providerForDateTimeWithTimezone
     */
    public function shouldValidateNoMatterTimezone(string $format, string $input, string $timezone): void
    {
        $currentTimezone = date_default_timezone_get();

        date_default_timezone_set($timezone);

        $rule = new DateTime($format);

        self::assertTrue($rule->validate($input));

        date_default_timezone_set($currentTimezone);
    }
}

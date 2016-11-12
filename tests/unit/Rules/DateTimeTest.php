<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTimeImmutable;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\DateTime
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class DateTimeTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new DateTime('c'), '2004-02-12T15:19:21+00:00'],
            [new DateTime('c'), '2005-12-30T01:02:03+01:00'],
            [new DateTime('d/m/Y'), '23/05/1987'],
            [new DateTime('g'), 0],
            [new DateTime('h'), 6],
            [new DateTime('r'), 'Thu, 29 Dec 2005 01:02:03 +0000'],
            [new DateTime('U'), 1464399539],
            [new DateTime('U'), 1464658596],
            [new DateTime('Ym'), '202302'],
            [new DateTime('Ym'), '202304'],
            [new DateTime('Ym'), '202306'],
            [new DateTime('Ym'), '202309'],
            [new DateTime('Ym'), '202311'],
            [new DateTime('Y-m-d'), '2009-09-09'],
            [new DateTime('z'), 320],
            [new DateTime(), 'today'],
            [new DateTime(), '2017-01-01'],
            [new DateTime(), '2005-12-30T01:02:03+01:00'],
            [new DateTime(), new \DateTime()],
            [new DateTime(), new \DateTimeImmutable()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new DateTime(), []],
            [new DateTime(), ''],
            [new DateTime(), new stdClass()],
            [new DateTime('Y-m-d'), '2009-12-00'],
            [new DateTime('Y-m-d'), '2016-02-30'],
            [new DateTime('Y-m-d'), new DateTime()],
            [new DateTime('Y-m-d'), new DateTimeImmutable()],
        ];
    }

    public function providerForDateTimeTimezoneStrings(): array
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
     * @dataProvider providerForDateTimeTimezoneStrings
     *
     * @param string $format
     * @param string $input
     * @param string $timezone
     */
    public function shouldValidateNoMatterTimezone($format, $input, $timezone): void
    {
        date_default_timezone_set($timezone);

        $rule = new DateTime($format);
        $result = $rule->apply($input);

        self::assertTrue($result->isValid());
    }

    /**
     * @test
     */
    public function shouldReturnScalarValResultAsChildWhenNonScalarValueIsGiven(): void
    {
        $rule = new DateTime();
        $result = $rule->apply([]);

        $firstChildren = $result->getChildren()[0];

        self::assertInstanceOf(ScalarVal::class, $firstChildren->getRule());
    }
}

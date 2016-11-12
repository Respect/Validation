<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use DateTime;
use DateTimeImmutable;
use stdClass;

/**
 * @group rule
 *
 * @covers Respect\Validation\Rules\Date
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class DateTest extends RuleTestCase2
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $noformat = new Date();
        $formatYm = new Date('Ym');
        $formatYmd = new Date('Y-m-d');
        $formatDmy = new Date('d/m/Y');
        $formatC = new Date('c');
        $formatR = new Date('r');
        $formatU = new Date('U');
        $formatG = new Date('g');
        $formatH = new Date('h');
        $formatZ = new Date('z');

        return [
            [$formatC, '2004-02-12T15:19:21+00:00'],
            [$formatC, '2005-12-30T01:02:03+01:00'],
            [$formatDmy, '23/05/1987'],
            [$formatG, 0],
            [$formatH, 6],
            [$formatR, 'Thu, 29 Dec 2005 01:02:03 +0000'],
            [$formatU, 1464399539],
            [$formatU, 1464658596],
            [$formatYm, '202302'],
            [$formatYm, '202304'],
            [$formatYm, '202306'],
            [$formatYm, '202309'],
            [$formatYm, '202311'],
            [$formatYmd, '2009-09-09'],
            [$formatZ, 320],
            [$noformat, 'today'],
            [$noformat, '2017-01-01'],
            [$noformat, '2005-12-30T01:02:03+01:00'],
            [$noformat, new DateTime()],
            [$noformat, new DateTimeImmutable()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $formatYmd = new Date('Y-m-d');
        $noformat = new Date();

        return [
            [$noformat, []],
            [$noformat, ''],
            [$noformat, new stdClass()],
            [$formatYmd, '2009-12-00'],
            [$formatYmd, '2016-02-30'],
            [$formatYmd, new DateTime()],
            [$formatYmd, new DateTimeImmutable()],
        ];
    }

    /**
     * @return array
     */
    public function providerForDateTimeTimezoneStrings()
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
    public function shouldValidateNoMatterTimezone($format, $input, $timezone)
    {
        date_default_timezone_set($timezone);

        $rule = new Date($format);
        $result = $rule->validate($input);

        $this->assertTrue($result->isValid());
    }

    /**
     * @test
     */
    public function shouldReturnScalarValResultAsChildWhenNonScalarValueIsGiven()
    {
        $rule = new Date();
        $result = $rule->validate([]);

        $firstChildren = $result->getChildren()[0];

        $this->assertInstanceOf(ScalarVal::class, $firstChildren->getRule());
    }
}

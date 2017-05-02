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

use DateTimeImmutable;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\DateTime
 * @covers \Respect\Validation\Exceptions\DateTimeException
 */
class DateTimeTest extends \PHPUnit_Framework_TestCase
{
    protected $dateValidator;

    protected function setUp()
    {
        $this->dateValidator = new DateTime();
    }

    public function testDateEmptyShouldNotValidate()
    {
        $this->assertFalse($this->dateValidator->__invoke(''));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\DateTimeException
     */
    public function testDateEmptyShouldNotCheck()
    {
        $this->dateValidator->check('');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\DateTimeException
     */
    public function testDateEmptyShouldNotAssert()
    {
        $this->dateValidator->assert('');
    }

    public function testDateWithoutFormatShouldValidate()
    {
        $this->assertTrue($this->dateValidator->__invoke('today'));
    }

    public function testDateTimeInstancesShouldAlwaysValidate()
    {
        $this->assertTrue($this->dateValidator->__invoke(new \DateTime('today')));
    }

    public function testDateTimeImmutableInterfaceInstancesShouldAlwaysValidate()
    {
        if (!class_exists('DateTimeImmutable')) {
            return $this->markTestSkipped('DateTimeImmutable does not exist');
        }

        $this->assertTrue($this->dateValidator->validate(new DateTimeImmutable('today')));
    }

    public function testInvalidDateShouldFail()
    {
        $this->assertFalse($this->dateValidator->__invoke('aids'));
    }
    public function testInvalidDateShouldFail_on_invalid_conversions()
    {
        $this->dateValidator->format = 'Y-m-d';
        $this->assertFalse($this->dateValidator->__invoke('2009-12-00'));
    }

    public function testAnyObjectExceptDateTimeInstancesShouldFail()
    {
        $this->assertFalse($this->dateValidator->__invoke(new \stdClass()));
    }

    public function testFormatsShouldValidateDateStrings()
    {
        $this->dateValidator = new DateTime('Y-m-d');
        $this->assertTrue($this->dateValidator->assert('2009-09-09'));
    }
    public function testFormatsShouldValidateDateStrings_with_any_formats()
    {
        $this->dateValidator = new DateTime('d/m/Y');
        $this->assertTrue($this->dateValidator->assert('23/05/1987'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\DateTimeException
     */
    public function testFormatsShouldValidateDateStrings_and_throw_DateTimeException_on_failure()
    {
        $this->dateValidator = new DateTime('y-m-d');
        $this->assertFalse($this->dateValidator->assert('2009-09-09'));
    }

    public function testDateTimeExceptionalFormatsThatShouldBeValid()
    {
        $this->dateValidator = new DateTime('c');
        $this->assertTrue($this->dateValidator->assert('2004-02-12T15:19:21+00:00'));

        $this->dateValidator = new DateTime('r');
        $this->assertTrue($this->dateValidator->assert('Thu, 29 Dec 2005 01:02:03 +0000'));
    }

    /**
     * Test that datetime strings with timezone information are valid independent on the system's timezone setting.
     *
     * @param string $systemTimezone
     * @param string $input
     * @dataProvider providerForDateTimeTimezoneStrings
     */
    public function testDateTimeSystemTimezoneIndependent($systemTimezone, $format, $input)
    {
        date_default_timezone_set($systemTimezone);
        $this->dateValidator = new DateTime($format);
        $this->assertTrue($this->dateValidator->assert($input));
    }

    /**
     * @return array
     */
    public function providerForDateTimeTimezoneStrings()
    {
        return [
                ['UTC', 'Ym', '202302'],
                ['UTC', 'Ym', '202304'],
                ['UTC', 'Ym', '202306'],
                ['UTC', 'Ym', '202309'],
                ['UTC', 'Ym', '202311'],
                ['UTC', 'c', '2005-12-30T01:02:03+01:00'],
                ['UTC', 'c', '2004-02-12T15:19:21+00:00'],
                ['UTC', 'r', 'Thu, 29 Dec 2005 01:02:03 +0000'],
                ['Europe/Amsterdam', 'c', '2005-12-30T01:02:03+01:00'],
                ['Europe/Amsterdam', 'c', '2004-02-12T15:19:21+00:00'],
                ['Europe/Amsterdam', 'r', 'Thu, 29 Dec 2005 01:02:03 +0000'],
                ['UTC', 'U', 1464658596],
                ['UTC', 'U', 1464399539],
                ['UTC', 'g', 0],
                ['UTC', 'h', 6],
                ['UTC', 'z', 320],
        ];
    }
}

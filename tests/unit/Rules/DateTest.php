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
 * @covers \Respect\Validation\Rules\Date
 * @covers \Respect\Validation\Exceptions\DateException
 */
class DateTest extends \PHPUnit_Framework_TestCase
{
    protected $dateValidator;

    protected function setUp()
    {
        $this->dateValidator = new Date();
    }

    public function testDateEmptyShouldNotValidate()
    {
        $this->assertFalse($this->dateValidator->__invoke(''));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\DateException
     */
    public function testDateEmptyShouldNotCheck()
    {
        $this->dateValidator->check('');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\DateException
     */
    public function testDateEmptyShouldNotAssert()
    {
        $this->dateValidator->assert('');
    }

    public function testDateWithoutFormatShouldNotValidate()
    {
        $this->assertFalse($this->dateValidator->__invoke('today'));
    }

    public function testDateInstancesShouldAlwaysValidate()
    {
        $this->assertTrue($this->dateValidator->__invoke(new \Datetime('today')));
    }

    public function testDateImmutableInterfaceInstancesShouldAlwaysValidate()
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

    public function testAnyObjectExceptDateInstancesShouldFail()
    {
        $this->assertFalse($this->dateValidator->__invoke(new \stdClass()));
    }

    public function testFormatsShouldValidateDateStrings()
    {
        $this->dateValidator = new Date('Y-m-d');
        $this->assertTrue($this->dateValidator->assert('2009-09-09'));
    }

    public function testFormatsShouldValidateDateStrings_with_any_formats()
    {
        $this->dateValidator = new Date('d/m/Y');
        $this->assertTrue($this->dateValidator->assert('23/05/1987'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\DateException
     */
    public function testFormatsShouldValidateDateStrings_and_throw_DateException_on_failure()
    {
        $this->dateValidator = new Date('y-m-d');
        $this->assertFalse($this->dateValidator->assert('2009-09-09'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\DateException
     * @dataProvider providerForWrongFormats
     */
    public function testInvalidateFormats($format)
    {
        $this->dateValidator = new Date($format);
        $this->assertFalse($this->dateValidator->assert('2009-09-09'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\DateException
     * @dataProvider providerForWrongFormats
     */
    public function testInvalidInputs($input)
    {
        $this->dateValidator = new Date('y-m-d');
        $this->assertFalse($this->dateValidator->assert($input));
    }

    /**
     * @return array
     */
    public function providerForWrongFormats()
    {
        return [
            ['g:i A'],
            ['g:i'],
            ['g:i:s'],
            ['G:i'],
            ['h:i A'],
            ['y-m-d g:i A'],
            ['y-m-d g:i'],
            ['y-m-d g:i:s'],
            ['y-m-d G:i'],
            ['y-m-d h:i A'],
            ['F jS, Y g:i A'],
            ['F jS, Y g:i'],
            ['F jS, Y g:i:s'],
            ['F jS, Y G:i'],
            ['F jS, Y h:i A']
        ];
    }

    /**
     * @return array
     */
    public function providerForDatetime() {
        return [
            ['2000-01-01T00:00:00+00:00'],
            ['2000-01-01T00:00:00+00:00.000'],
            ['2013-02-08 09:30:26.123+07:00'],
            ['2010-10-20 4:30 +0000'],
            ['2015-06-19 00:00:00']
        ];
    }
}

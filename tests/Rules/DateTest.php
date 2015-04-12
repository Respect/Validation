<?php
namespace Respect\Validation\Rules;

use DateTime;

class DateTest extends \PHPUnit_Framework_TestCase
{
    protected $dateValidator;

    protected function setUp()
    {
        $this->dateValidator = new Date;
    }

    public function testDateEmptyShouldValidate()
    {
        $this->assertTrue($this->dateValidator->__invoke(''));
        $this->assertTrue($this->dateValidator->check(''));
        $this->assertTrue($this->dateValidator->assert(''));
    }

    public function testDateWithoutFormatShouldValidate()
    {
        $this->assertTrue($this->dateValidator->__invoke('today'));
    }

    public function testDateTimeInstancesShouldAlwaysValidate()
    {
        $this->assertTrue($this->dateValidator->__invoke(new DateTime('today')));
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
        $this->assertFalse($this->dateValidator->__invoke(new \stdClass));
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
     * @expectedException Respect\Validation\Exceptions\DateException
     */
    public function testFormatsShouldValidateDateStrings_and_throw_DateException_on_failure()
    {
        $this->dateValidator = new Date('y-m-d');
        $this->assertFalse($this->dateValidator->assert('2009-09-09'));
    }

    public function testDateTimeExceptionalFormatsThatShouldBeValid()
    {
        $this->dateValidator = new Date('c');
        $this->assertTrue($this->dateValidator->assert('2004-02-12T15:19:21+00:00'));

        $this->dateValidator = new Date('r');
        $this->assertTrue($this->dateValidator->assert('Thu, 29 Dec 2005 01:02:03 +0000'));
    }

    public function testDateTimeSystemTimezoneIndependent()
    {
        date_default_timezone_set('UTC');
        $this->dateValidator = new Date('c');
        $this->assertTrue($this->dateValidator->assert('2004-02-12T15:19:21+00:00'));

        $this->dateValidator = new Date('c');
        $this->assertTrue($this->dateValidator->assert('2004-02-12T16:19:21+01:00'));

        date_default_timezone_set('Europe/Amsterdam');
        $this->dateValidator = new Date('c');
        $this->assertTrue($this->dateValidator->assert('2004-02-12T15:19:21+00:00'));

        $this->dateValidator = new Date('c');
        $this->assertTrue($this->dateValidator->assert('2004-02-12T16:19:21+01:00'));
    }
}


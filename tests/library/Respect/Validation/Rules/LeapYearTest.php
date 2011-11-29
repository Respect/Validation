<?php

namespace Respect\Validation\Rules;

use DateTime;

class LeapYearTest extends \PHPUnit_Framework_TestCase
{

    protected $leapYearValidator;

    protected function setUp()
    {
        $this->leapYearValidator = new LeapYear;
    }

    public function test_valid_leap_date()
    {
        $this->assertTrue($this->leapYearValidator->validate('2008'));
        $this->assertTrue($this->leapYearValidator->validate('2008-02-29'));
        $this->assertTrue($this->leapYearValidator->validate(2008));
        $this->assertTrue($this->leapYearValidator->validate(
            new DateTime('2008-02-29')));
    }

    public function test_invalid_leap_date()
    {
        $this->assertFalse($this->leapYearValidator->validate('2009'));
        $this->assertFalse($this->leapYearValidator->validate('2009-02-29'));
        $this->assertFalse($this->leapYearValidator->validate(2009));
        $this->assertFalse($this->leapYearValidator->validate(
            new DateTime('2009-02-29')));
        $this->assertFalse($this->leapYearValidator->validate(array()));
    }
}

<?php

namespace Respect\Validation\Rules;

use DateTime;

class LeapDateTest extends \PHPUnit_Framework_TestCase
{

    protected $dateValidator;

    protected function setUp()
    {
        $this->leapDateValidator = new LeapDate('Y-m-d');
    }

    public function test_valid_leap_date()
    {
        $this->assertTrue($this->leapDateValidator->validate('1988-02-29'));
    }

    public function test_invalid_leap_date()
    {
        $this->assertFalse($this->leapDateValidator->validate('1989-02-29'));
    }
    
}

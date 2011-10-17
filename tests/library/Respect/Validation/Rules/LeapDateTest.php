<?php

namespace Respect\Validation\Rules;

use DateTime;

class LeapDateTest extends \PHPUnit_Framework_TestCase
{

    protected $leapDateValidator;

    protected function setUp()
    {
        $this->leapDateValidator = new LeapDate;
    }

    public function test_valid_leap_date()
    {
        $this->assertTrue($this->leapDateValidator->validate('2008-02-29', 'Y-m-d'));
    }

    public function test_invalid_leap_date()
    {
        $this->assertFalse($this->leapDateValidator->validate('2009-02-29', 'Y-m-d'));
    }
}

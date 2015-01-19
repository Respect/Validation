<?php
namespace Respect\Validation\Rules;

use DateTime;

class LeapDateTest extends \PHPUnit_Framework_TestCase
{
    protected $leapDateValidator;

    protected function setUp()
    {
        $this->leapDateValidator = new LeapDate('Y-m-d');
    }

    public function testValidLeapDate_with_string()
    {
        $this->assertTrue($this->leapDateValidator->validate('1988-02-29'));
    }

    public function testValidLeapDate_with_date_time()
    {
        $this->assertTrue($this->leapDateValidator->validate(
            new DateTime('1988-02-29')));
    }

    public function testInvalidLeapDate_with_string()
    {
        $this->assertFalse($this->leapDateValidator->validate('1989-02-29'));
    }

    public function testInvalidLeapDate_with_date_time()
    {
        $this->assertFalse($this->leapDateValidator->validate(
            new DateTime('1989-02-29')));
    }
    public function testInvalidLeapDate_input()
    {
        $this->assertFalse($this->leapDateValidator->validate(array()));
    }
}


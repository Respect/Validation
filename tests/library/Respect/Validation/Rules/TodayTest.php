<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validator;
use DateTime;

class TodayTest extends \PHPUnit_Framework_TestCase
{
    private $todayValidation = null;

    protected function setUp()
    {
        $this->todayValidation = new Today;
    }

    public function test_today_using_string_should_pass() {
        $today = date('Y-m-d');
        $this->assertTrue($this->todayValidation->validate($today));
    }

    public function test_invalid_date_should_fail() {
        $this->assertFalse($this->todayValidation->validate('wrong date'));
    }

    public function test_today_using_DateTime_should_pass() {
        $this->assertTrue($this->todayValidation->validate(new DateTime('today')));
    }
    
    public function test_today_using_object_should_fail() {
        $this->assertFalse($this->todayValidation->validate(new \stdClass()));
    }

    public function test_today_using_formats_should_pass() {
        $this->todayValidation = new Today('d/m/Y');
        $today = date('d/m/Y');

        $this->assertTrue($this->todayValidation->validate($today));
    }

    public function test_today_using_wrong_format_should_fail() {
        $today = date('d/m/Y');

        $this->assertFalse($this->todayValidation->validate($today));
    }

    public function test_not_today_should_pass() {
        $this->assertTrue(Validator::not(Validator::today())->validate('1988-01-01'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\TodayException
     */
    public function test_invalid_date_should_raise_exception()
    {
        $this->assertFalse($this->todayValidation->assert('1988-12-29'));
    }
}
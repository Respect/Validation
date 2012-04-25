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

    public function test_date_without_format_should_validate()
    {
        $this->assertTrue($this->dateValidator->validate('today'));
    }

    public function test_DateTime_instances_should_always_validate()
    {
        $this->assertTrue($this->dateValidator->validate(new DateTime('today')));
    }

    public function test_invalid_date_should_fail()
    {
        $this->assertFalse($this->dateValidator->validate('aids'));
    }
    public function test_invalid_date_should_fail_on_invalid_convertions()
    {
        $this->dateValidator->format = 'Y-m-d';
        $this->assertFalse($this->dateValidator->validate('2009-12-00'));
    }

    public function test_any_object_except_DateTime_instances_should_fail()
    {
        $this->assertFalse($this->dateValidator->validate(new \stdClass));
    }

    public function test_formats_should_validate_date_strings()
    {
        $this->dateValidator = new Date('Y-m-d');
        $this->assertTrue($this->dateValidator->assert('2009-09-09'));
    }
    public function test_formats_should_validate_date_strings_with_any_formats()
    {
        $this->dateValidator = new Date('d/m/Y');
        $this->assertTrue($this->dateValidator->assert('23/05/1987'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\DateException
     */
    public function test_formats_should_validate_date_strings_and_throw_DateException_on_failure()
    {
        $this->dateValidator = new Date('y-m-d');
        $this->assertFalse($this->dateValidator->assert('2009-09-09'));
    }

}
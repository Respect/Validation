<?php

namespace Respect\Validation\Rules;

use DateTime;

class DateTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Date;
    }

    protected function tearDown()
    {
        unset($this->object);
    }

    public function testDateWithoutFormat()
    {
        $this->assertTrue($this->object->validate('today'));
    }

    public function testDateInstance()
    {
        $this->assertTrue($this->object->validate(new DateTime('today')));
    }

    public function testInvalidDateWithoutFormat()
    {
        $this->assertFalse($this->object->validate('aids'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testDateFormat()
    {
        $this->object = new Date('Y-m-');
        $this->assertTrue($this->object->assert('2009-09-09'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testInvalidDateFormat()
    {
        $this->object = new Date('y-m-d');
        $this->assertFalse($this->object->assert('2009-09-09'));
    }

}
<?php

namespace Respect\Validation\Rules;

class NullValueTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new NullValue;
    }

    public function testNullValue()
    {
        $this->assertTrue($this->object->assert(null));
        $this->assertTrue($this->object->validate(null));
        $this->assertTrue($this->object->check(null));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\NullValueException
     */
    public function testNotNull()
    {
        $this->assertFalse($this->object->validate('w poiur'));
        $this->assertFalse($this->object->assert('w poiur'));
    }

}
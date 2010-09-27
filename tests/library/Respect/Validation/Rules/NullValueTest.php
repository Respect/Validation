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
    }

    /**
     * @expectedException Respect\Validation\Exceptions\NotNullException
     */
    public function testNotNull()
    {
        $this->assertTrue($this->object->assert('w poiur'));
    }

}
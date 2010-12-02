<?php

namespace Respect\Validation\Rules;

class InstanceTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Instance('ArrayObject');
    }

    public function testInstance()
    {
        $this->assertTrue($this->object->assert(new \ArrayObject));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testNotInstance()
    {
        $this->assertTrue($this->object->assert(new \stdClass));
    }

}
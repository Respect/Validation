<?php

namespace Respect\Validation\Rules;

class ObjectTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Object;
    }

    /**
     * @dataProvider providerForObject
     *
     */
    public function testObject($input)
    {
        $this->assertTrue($this->object->validate($input));
        $this->assertTrue($this->object->assert($input));
        $this->assertTrue($this->object->check($input));
    }

    /**
     * @dataProvider providerForNotObject
     * @expectedException Respect\Validation\Exceptions\ObjectException
     */
    public function testNotObject($input)
    {
        $this->assertFalse($this->object->validate($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForObject()
    {
        return array(
            array(new \stdClass),
            array(new \ArrayObject),
        );
    }

    public function providerForNotObject()
    {
        return array(
            array(null),
            array(121),
            array(array()),
            array('Foo'),
            array(false),
        );
    }

}
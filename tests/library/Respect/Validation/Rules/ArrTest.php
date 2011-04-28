<?php

namespace Respect\Validation\Rules;

class ArrTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Arr;
    }

    /**
     * @dataProvider providerForArray
     *
     */
    public function testArray($input)
    {
        $this->assertTrue($this->object->validate($input));
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotArray
     * @expectedException Respect\Validation\Exceptions\ArrException
     */
    public function testNotArray($input)
    {
        $this->assertFalse($this->object->validate($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForArray()
    {
        return array(
            array(array()),
            array(array(1, 2, 3)),
            array(new \ArrayObject),
        );
    }

    public function providerForNotArray()
    {
        return array(
            array(null),
            array(121),
            array(new \stdClass),
            array(false),
            array('aaa'),
        );
    }

}
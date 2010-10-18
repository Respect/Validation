<?php

namespace Respect\Validation\Rules;

class FloatTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Float;
    }

    /**
     * @dataProvider providerForFloat
     *
     */
    public function testFloat($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotFloat
     * @expectedException Respect\Validation\Exceptions\NotFloatException
     */
    public function testNotFloat($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    public function providerForFloat()
    {
        return array(
            array(165.0),
            array('165.7'),
            array(1e12),
        );
    }

    public function providerForNotFloat()
    {
        return array(
            array(null),
            array('a'),
            array(' '),
            array('Foo'),
            array(''),
        );
    }

}
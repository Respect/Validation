<?php

namespace Respect\Validation\Rules;

class PositiveTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Positive;
    }

    /**
     * @dataProvider providerForPositive
     *
     */
    public function testPositive($input)
    {
        $this->assertTrue($this->object->validate($input));
        $this->assertTrue($this->object->check($input));
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotPositive
     * @expectedException Respect\Validation\Exceptions\PositiveException
     */
    public function testNotPositive($input)
    {
        $this->assertFalse($this->object->validate($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForPositive()
    {
        return array(
            array(16),
            array('165'),
            array(123456),
            array(1e10),
        );
    }

    public function providerForNotPositive()
    {
        return array(
            array(null),
            array('a'),
            array(' '),
            array('Foo'),
            array(''),
            array('-1.44'),
            array(-1e-5),
            array(0),
            array(-0),
            array(-10),
        );
    }

}
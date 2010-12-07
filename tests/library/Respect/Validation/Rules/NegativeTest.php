<?php

namespace Respect\Validation\Rules;

class NegativeTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Negative;
    }

    /**
     * @dataProvider providerForNegative
     *
     */
    public function testNegative($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotNegative
     * @expectedException Respect\Validation\Exceptions\NegativeException
     */
    public function testNotNegative($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    public function providerForNegative()
    {
        return array(
            array('-1.44'),
            array(-1e-5),
            array(-10),
        );
    }

    public function providerForNotNegative()
    {
        return array(
            array(0),
            array(-0),
            array(null),
            array('a'),
            array(' '),
            array('Foo'),
            array(''),
            array(16),
            array('165'),
            array(123456),
            array(1e10),
        );
    }

}
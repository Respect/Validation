<?php

namespace Respect\Validation\Rules;

class IntTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Int;
    }

    /**
     * @dataProvider providerForInt
     *
     */
    public function testInt($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotInt
     * @expectedException Respect\Validation\Exceptions\IntException
     */
    public function testNotInt($input)
    {
        $this->assertTrue($this->object->assert($input));
    }


    /**
     * @dataProvider providerForFilterInt
     */
    public function testIntFiltering($unfiltered, $expected)
    {
        $this->assertSame($expected, $this->object->filter($unfiltered));
    }

    public function providerForInt()
    {
        return array(
            array(16),
            array('165'),
            array(123456),
            array(PHP_INT_MAX),
        );
    }

    public function providerForNotInt()
    {
        return array(
            array(null),
            array('a'),
            array(' '),
            array('Foo'),
            array(''),
            array('1.44'),
            array(1e-5),
        );
    }

    public function providerForFilterInt()
    {
        return array(
            array(12, 12),
            array('12 rabbits', 12),
            array('1.44', 1),
            array(1e-5, 0),
        );
    }

}
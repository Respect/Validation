<?php

namespace Respect\Validation\Rules;

class DigitsTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Digits;
    }

    /**
     * @dataProvider providerForDigits
     *
     */
    public function testDigits($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotDigits
     * @expectedException Respect\Validation\Exceptions\NotDigitsException
     */
    public function testNotDigits($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    public function providerForDigits()
    {
        return array(
            array(165),
            array(1650),
            array('165'),
            array('1650'),
        );
    }

    public function providerForNotDigits()
    {
        return array(
            array(null),
            array('a'),
            array(' '),
            array('Foo'),
            array(''),
            array('12.1'),
            array('-12'),
            array(-12),
        );
    }

}
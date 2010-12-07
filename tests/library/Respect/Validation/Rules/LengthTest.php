<?php

namespace Respect\Validation\Rules;

class LengthTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidLenght
     */
    public function testLengthValid($string, $min, $max)
    {
        $validator = new Length($min, $max);
        $this->assertTrue($validator->assert($string));
    }

    /**
     * @dataProvider providerForInvalidLenght
     * @expectedException Respect\Validation\Exceptions\LengthException
     */
    public function testLengthInvalid($string, $min, $max)
    {
        $validator = new Length($min, $max);
        $this->assertFalse($validator->assert($string));
    }

    /**
     * @dataProvider providerForComponentException
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testLengthComponentException($string, $min, $max)
    {
        $validator = new Length($min, $max);
        $this->assertFalse($validator->assert($string));
    }

    public function providerForValidLenght()
    {
        return array(
            array('alganet', 1, 15),
            array(range(1, 20), 1, 30),
            array('alganet', 1, null), //null is a valid max length, means "no maximum",
            array('alganet', null, 15) //null is a valid min length, means "no minimum"
        );
    }

    public function providerForInvalidLenght()
    {
        return array(
            array('alganet', 1, 3),
            array(range(1, 50), 1, 30),
        );
    }

    public function providerForComponentException()
    {
        return array(
            array('alganet', 'a', 15),
            array('alganet', 1, 'abc d'),
        );
    }

}
<?php

namespace Respect\Validation\Rules;

class StringLengthTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidLenght
     */
    public function testStringLengthValid($string, $min, $max)
    {
        $validator = new StringLength($min, $max);
        $this->assertTrue($validator->assert($string));
    }

    /**
     * @dataProvider providerForInvalidLenght
     * @expectedException Respect\Validation\Exceptions\StringLengthException
     */
    public function testStringLengthInvalid($string, $min, $max)
    {
        $validator = new StringLength($min, $max);
        $this->assertFalse($validator->assert($string));
    }

    public function providerForValidLenght()
    {
        return array(
            array('alganet', 1, 15)
        );
    }

    public function providerForInvalidLenght()
    {
        return array(
            array('alganet', 1, 3)
        );
    }

}
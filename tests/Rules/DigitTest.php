<?php
namespace Respect\Validation\Rules;

class DigitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidDigits
     */
    public function testValidDataWithDigitsShouldReturnTrue($validDigits, $additional='')
    {
        $validator = new Digit($additional);
        $this->assertTrue($validator->validate($validDigits));
    }

    /**
     * @dataProvider providerForInvalidDigits
     * @expectedException Respect\Validation\Exceptions\DigitException
     */
    public function testInvalidDigitsShouldFailAndThrowDigitException($invalidDigits, $additional='')
    {
        $validator = new Digit($additional);
        $this->assertFalse($validator->validate($invalidDigits));
        $this->assertFalse($validator->assert($invalidDigits));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional)
    {
        $validator = new Digit($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($additional, $query)
    {
        $validator = new Digit($additional);
        $this->assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return array(
            array('!@#$%^&*(){}', '!@#$%^&*(){} 123'),
            array('[]?+=/\\-_|"\',<>.', "[]?+=/\\-_|\"',<>. \t \n 123"),
        );
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidDigits()
    {
        return array(
            array(''),
            array("\n\t"),
            array(' '),
            array(165),
            array(1650),
            array('01650'),
            array('165'),
            array('1650'),
            array('16 50'),
            array("\n5\t"),
            array('16-50', '-'),
        );
    }

    public function providerForInvalidDigits()
    {
        return array(
            array(null),
            array('16-50'),
            array('a'),
            array('Foo'),
            array('12.1'),
            array('-12'),
            array(-12),
        );
    }
}


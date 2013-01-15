<?php

namespace Respect\Validation\Rules;

class DigitTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidDigit
     */
    public function testValidDataWithDigitsShouldReturnTrue($validDigit, $aditional='')
    {
        $validator = new Digit($aditional);
        $this->assertTrue($validator->validate($validDigit));
    }

    /**
     * @dataProvider providerForInvalidDigit
     * @expectedException Respect\Validation\Exceptions\DigitException
     */
    public function testInvalidDigitsShouldFailAndHhrowDigitException($invalidDigit, $aditional='')
    {
        $validator = new Digit($aditional);
        $this->assertFalse($validator->validate($invalidDigit));
        $this->assertFalse($validator->assert($invalidDigit));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($aditional)
    {
        $validator = new Digit($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidDigit()
    {
        return array(
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

    public function providerForInvalidDigit()
    {
        return array(
            array(null),
            array('16-50'),
            array('a'),
            array(' '),
            array('Foo'),
            array(''),
            array("\n\t"),
            array('12.1'),
            array('-12'),
            array(-12),
        );
    }

}

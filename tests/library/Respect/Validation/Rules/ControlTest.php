<?php

namespace Respect\Validation\Rules;

class ControlTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidControl
     */
    public function testValidDataWithControlShouldReturnTrue($validControl, $aditional='')
    {
        $validator = new Control($aditional);
        $this->assertTrue($validator->validate($validControl));
    }

    /**
     * @dataProvider providerForInvalidControl
     * @expectedException Respect\Validation\Exceptions\ControlException
     */
    public function testInvalidControlShouldFailAndThrowDigitsException($invalidControl, $aditional='')
    {
        $validator = new Control($aditional);
        $this->assertFalse($validator->validate($invalidControl));
        $this->assertFalse($validator->assert($invalidControl));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($aditional)
    {
        $validator = new Control($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidControl()
    {
        return array(
            array(''),
            array("\n"),
            array("\r"),
            array("\t"),
            array("\n\r\t"),
            array("\n \n", ' '),
        );
    }

    public function providerForInvalidControl()
    {
        return array(
            array('16-50'),
            array('a'),
            array(' '),
            array('Foo'),
            array('12.1'),
            array('-12'),
            array(-12),
            array('alganet'),
        );
    }

}

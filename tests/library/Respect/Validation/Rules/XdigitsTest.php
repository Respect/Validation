<?php

namespace Respect\Validation\Rules;

class XdigitsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidXdigits
     */
    public function testValidDataWithXdigitsShouldReturnTrue($validXdigits, $aditional='')
    {
        $validator = new Xdigits($aditional);
        $this->assertTrue($validator->validate($validXdigits));
    }

    /**
     * @dataProvider providerForInvalidXdigits
     * @expectedException Respect\Validation\Exceptions\XdigitsException
     */
    public function testInvalidXdigitsShouldFailAndThrowXdigitsException($invalidXdigits, $aditional='')
    {
        $validator = new Xdigits($aditional);
        $this->assertFalse($validator->validate($invalidXdigits));
        $this->assertFalse($validator->assert($invalidXdigits));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($aditional)
    {
        $validator = new Xdigits($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidXdigits()
    {
        return array(
            array(165),
            array(1650),
            array('01650'),
            array('165'),
            array('1650'),
            array('16 50'),
            array('deadbeef'),
            array('DEADBEEF'),
            array("\n5\t"),
            array('a'),
            array('16-50', '-'),
        );
    }

    public function providerForInvalidXdigits()
    {
        return array(
            array(null),
            array('16-50'),
            array(' '),
            array('Foo'),
            array(''),
            array('g'),
            array("\n\t"),
            array('12.1'),
            array('-12'),
            array(-12),
        );
    }

}

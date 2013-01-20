<?php

namespace Respect\Validation\Rules;

class PrintableTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidPrintable
     */
    public function testValidDataWithPrintableCharsShouldReturnTrue($validPrintable, $aditional='')
    {
        $validator = new Printable($aditional);
        $this->assertTrue($validator->validate($validPrintable));
    }

    /**
     * @dataProvider providerForInvalidPrintable
     * @expectedException Respect\Validation\Exceptions\PrintableException
     */
    public function testInvalidPrintableShouldFailAndThrowPrintableException($invalidPrintable, $aditional='')
    {
        $validator = new Printable($aditional);
        $this->assertFalse($validator->validate($invalidPrintable));
        $this->assertFalse($validator->assert($invalidPrintable));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($aditional)
    {
        $validator = new Printable($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidPrintable()
    {
        return array(
            array('LKA#@%.54'),
            array('foobar'),
            array('16-50'),
            array('foo bar'),
        );
    }

    public function providerForInvalidPrintable()
    {
        return array(
            array(null),
            array(''),
            array("foo\nbar"),
            array("foo\tbar"),
        );
    }

}

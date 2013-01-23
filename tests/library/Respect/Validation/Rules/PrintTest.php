<?php
namespace Respect\Validation\Rules;

class PrintTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidPrint
     */
    public function testValidDataWithPrintCharsShouldReturnTrue($validPrint, $aditional='')
    {
        $validator = new Print($aditional);
        $this->assertTrue($validator->validate($validPrint));
    }

    /**
     * @dataProvider providerForInvalidPrint
     * @expectedException Respect\Validation\Exceptions\PrintException
     */
    public function testInvalidPrintShouldFailAndThrowPrintException($invalidPrint, $aditional='')
    {
        $validator = new Print($aditional);
        $this->assertFalse($validator->validate($invalidPrint));
        $this->assertFalse($validator->assert($invalidPrint));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($aditional)
    {
        $validator = new Print($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidPrint()
    {
        return array(
            array(''),
            array(' '),
            array('LKA#@%.54'),
            array('foobar'),
            array('16-50'),
            array('123'),
            array('foo bar'),
            array('#$%&*_'),
        );
    }

    public function providerForInvalidPrint()
    {
        return array(
            array(null),
            array("foo\nbar"),
            array("foo\tbar"),
        );
    }
}


<?php
namespace Respect\Validation\Rules;

class PrntTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidPrint
     */
    public function testValidDataWithPrintCharsShouldReturnTrue($validPrint, $aditional='')
    {
        $validator = new Prnt($aditional);
        $this->assertTrue($validator->validate($validPrint));
    }

    /**
     * @dataProvider providerForInvalidPrint
     * @expectedException Respect\Validation\Exceptions\PrntException
     */
    public function testInvalidPrintShouldFailAndThrowPrntException($invalidPrint, $aditional='')
    {
        $validator = new Prnt($aditional);
        $this->assertFalse($validator->validate($invalidPrint));
        $this->assertFalse($validator->assert($invalidPrint));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($aditional)
    {
        $validator = new Prnt($aditional);
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($aditional, $query)
    {
        $validator = new Prnt($aditional);
        $this->assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return array(
            array("\t\n", "\t\n "),
            array("\v\r", "\v\r "),
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


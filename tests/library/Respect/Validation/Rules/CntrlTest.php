<?php
namespace Respect\Validation\Rules;

class CntrlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidCntrl
     */
    public function testValidDataWithCntrlShouldReturnTrue($validCntrl, $aditional='')
    {
        $validator = new Cntrl($aditional);
        $this->assertTrue($validator->validate($validCntrl));
    }

    /**
     * @dataProvider providerForInvalidCntrl
     * @expectedException Respect\Validation\Exceptions\CntrlException
     */
    public function testInvalidCntrlShouldFailAndThrowCntrlException($invalidCntrl, $aditional='')
    {
        $validator = new Cntrl($aditional);
        $this->assertFalse($validator->validate($invalidCntrl));
        $this->assertFalse($validator->assert($invalidCntrl));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($aditional)
    {
        $validator = new Cntrl($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidCntrl()
    {
        return array(
            array(''),
            array("\n"),
            array("\r"),
            array("\t"),
            array("\n\r\t"),
//            array("\n \n", ' '), TODO Verify this
        );
    }

    public function providerForInvalidCntrl()
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


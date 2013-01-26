<?php
namespace Respect\Validation\Rules;

class SpaceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidSpace
     */
    public function testValidDataWithSpaceShouldReturnTrue($validSpace, $aditional='')
    {
        $validator = new Space($aditional);
        $this->assertTrue($validator->validate($validSpace));
    }

    /**
     * @dataProvider providerForInvalidSpace
     * @expectedException Respect\Validation\Exceptions\SpaceException
     */
    public function testInvalidSpaceShouldFailAndThrowSpaceException($invalidSpace, $aditional='')
    {
        $validator = new Space($aditional);
        $this->assertFalse($validator->validate($invalidSpace));
        $this->assertFalse($validator->assert($invalidSpace));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($aditional)
    {
        $validator = new Space($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidSpace()
    {
        return array(
            array(''),
            array("\n"),
            array(" "),
            array("    "),
            array("\t"),
            array("	"),
        );
    }

    public function providerForInvalidSpace()
    {
        return array(
            array('16-50'),
            array('a'),
            array('Foo'),
            array('12.1'),
            array('-12'),
            array(-12),
            array('_'),
        );
    }
}


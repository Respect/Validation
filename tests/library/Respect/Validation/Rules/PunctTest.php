<?php
namespace Respect\Validation\Rules;

class PunctTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidPunct
     */
    public function testValidDataWithPunctShouldReturnTrue($validPunct, $aditional='')
    {
        $validator = new Punct($aditional);
        $this->assertTrue($validator->validate($validPunct));
    }

    /**
     * @dataProvider providerForInvalidPunct
     * @expectedException Respect\Validation\Exceptions\PunctException
     */
    public function testInvalidPunctShouldFailAndThrowPunctException($invalidPunct, $aditional='')
    {
        $validator = new Punct($aditional);
        $this->assertFalse($validator->validate($invalidPunct));
        $this->assertFalse($validator->assert($invalidPunct));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($aditional)
    {
        $validator = new Punct($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidPunct()
    {
        return array(
            array(''),
            array('.'),
            array(',;:'),
            array('-@#$*'),
            array('()[]{}'),
        );
    }

    public function providerForInvalidPunct()
    {
        return array(
            array('16-50'),
            array('a'),
            array(' '),
            array('Foo'),
            array('12.1'),
            array('-12'),
            array(-12),
            array('( )_{}'),
        );
    }
}


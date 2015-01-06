<?php
namespace Respect\Validation\Rules;

class HexRgbColorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidHexRgbColor
     */
    public function testHexRgbColorValuesONLYShouldReturnTrue($validHexRgbColor)
    {
        $validator = new HexRgbColor();
        $this->assertTrue($validator->__invoke($validHexRgbColor));
        $this->assertTrue($validator->check($validHexRgbColor));
        $this->assertTrue($validator->assert($validHexRgbColor));
    }

    /**
     * @dataProvider providerForInvalidHexRgbColor
     * @expectedException Respect\Validation\Exceptions\HexRgbColorException
     */
    public function testInvalidHexRgbColorValuesShouldReturnFalse($invalidHexRgbColor)
    {
        $validator = new HexRgbColor();
        $this->assertFalse($validator->__invoke($invalidHexRgbColor));
        $this->assertFalse($validator->check($invalidHexRgbColor));
        $this->assertFalse($validator->assert($invalidHexRgbColor));
    }
    
    public function providerForValidHexRgbColor()
    {
        return array(
            array('#123456'),
            array('#123'),
            array('#FFFFFF'),
            array('123123'),
            array('FFFFFF')
        );
    }
    
    public function providerForInvalidHexRgbColor()
    {
        return array(
            array('foo'),
            array(new \stdClass()),
            array(array()),
            array(null),
            array('#0'),
            array('#1234'),
            array('1234'),
            array(1),
            array(005),
            array(443),
            array(000099),
            array('#AAAAAA1'),
            array('#S')
        );
    }
}


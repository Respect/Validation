<?php
namespace Respect\Validation\Rules;

class HexRgbColorTest extends \PHPUnit_Framework_TestCase
{
    public function testHexRgbColorValuesONLYShouldReturnTrue()
    {
        $validator = new HexRgbColor();
        $this->assertTrue($validator->assert('#0'));
        $this->assertTrue($validator->assert('#123456'));
        $this->assertTrue($validator->assert('#1234'));
        $this->assertTrue($validator->assert('#1234'));
        $this->assertTrue($validator->assert('#FFFFF'));
        $this->assertTrue($validator->assert('123123'));
        $this->assertTrue($validator->assert('FFFFF'));
        $this->assertTrue($validator->assert(1));
        $this->assertTrue($validator->assert(0));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\HexRgbColorException
     */
    public function testInvalidHexRgbColorShouldRaiseException()
    {
        $validator = new HexRgbColor();
        $this->assertFalse($validator->check('#AAAAAA1'));
        $this->assertFalse($validator->check('#S'));
    }

    public function testInvalidHexRgbColorValuesShouldReturnFalse()
    {
        $validator = new HexRgbColor();
        $this->assertFalse($validator->__invoke('foo'));
        $this->assertFalse($validator->__invoke(new \stdClass()));
        $this->assertFalse($validator->__invoke(array()));
        $this->assertFalse($validator->__invoke(null));
    }
}


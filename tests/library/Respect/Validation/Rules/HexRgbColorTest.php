<?php
namespace Respect\Validation\Rules;

class HexRgbColorTest extends \PHPUnit_Framework_TestCase
{
    public function testHexRgbColorValuesONLYShouldReturnTrue()
    {
        $validator = new HexRgbColor();
        $this->assertTrue($validator->assert('#123456'));
        $this->assertTrue($validator->assert('#123'));
        $this->assertTrue($validator->assert('#FFFFFF'));
        $this->assertTrue($validator->assert('123123'));
        $this->assertTrue($validator->assert('FFFFFF'));
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
        $this->assertFalse($validator->__invoke('#0'));
        $this->assertFalse($validator->__invoke('#1234'));
        $this->assertFalse($validator->__invoke('1234'));
        $this->assertFalse($validator->__invoke(1));
        $this->assertFalse($validator->__invoke(005));
        $this->assertFalse($validator->__invoke(443));
        $this->assertFalse($validator->__invoke(000099));
    }
}


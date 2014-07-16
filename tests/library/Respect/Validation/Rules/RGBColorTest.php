<?php
namespace Respect\Validation\Rules;

class RGBColorTest extends \PHPUnit_Framework_TestCase
{
    public function testRGBColorValuesONLYShouldReturnTrue()
    {
        $validator = new RGBColor();
        $this->assertTrue($validator->assert('#0'));
        $this->assertTrue($validator->assert('#123456'));
        $this->assertTrue($validator->assert('#1234'));
        $this->assertTrue($validator->assert('#1234'));
        $this->assertTrue($validator->assert('#FFFFF'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\RGBColorException
     */
    public function testInvalidRGBColorShouldRaiseException()
    {
        $validator = new RGBColor();
        $this->assertFalse($validator->check('#AAAAAA1'));
        $this->assertFalse($validator->check('#S'));
    }

    public function testInvalidRGBColorValuesShouldReturnFalse()
    {
        $validator = new RGBColor();
        $this->assertFalse($validator->__invoke('foo'));
        $this->assertFalse($validator->__invoke(123123));
        $this->assertFalse($validator->__invoke(new \stdClass()));
        $this->assertFalse($validator->__invoke(array()));
        $this->assertFalse($validator->__invoke(1));
        $this->assertFalse($validator->__invoke(0));
        $this->assertFalse($validator->__invoke(null));
    }
}


<?php
namespace Respect\Validation\Rules;

class BoolTest extends \PHPUnit_Framework_TestCase
{
    public function testBooleanValuesONLYShouldReturnTrue()
    {
        $validator = new Bool();
        $this->assertTrue($validator->__invoke(''));
        $this->assertTrue($validator->__invoke(true));
        $this->assertTrue($validator->__invoke(false));
        $this->assertTrue($validator->assert(true));
        $this->assertTrue($validator->assert(false));
        $this->assertTrue($validator->check(true));
        $this->assertTrue($validator->check(false));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\BoolException
     */
    public function testInvalidBooleanShouldRaiseException()
    {
        $validator = new Bool();
        $this->assertFalse($validator->check('foo'));
    }

    public function testInvalidBooleanValuesShouldReturnFalse()
    {
        $validator = new Bool();
        $this->assertFalse($validator->__invoke('foo'));
        $this->assertFalse($validator->__invoke(123123));
        $this->assertFalse($validator->__invoke(new \stdClass()));
        $this->assertFalse($validator->__invoke(array()));
        $this->assertFalse($validator->__invoke(1));
        $this->assertFalse($validator->__invoke(0));
        $this->assertFalse($validator->__invoke(null));
    }
}


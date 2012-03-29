<?php

namespace Respect\Validation\Rules;

class BoolTest extends \PHPUnit_Framework_TestCase
{

    public function test_boolean_values_ONLY_should_return_true()
    {
        $validator = new Bool();
        $this->assertTrue($validator->validate(true));
        $this->assertTrue($validator->validate(false));
        $this->assertTrue($validator->assert(true));
        $this->assertTrue($validator->assert(false));
        $this->assertTrue($validator->check(true));
        $this->assertTrue($validator->check(false));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\BoolException
     */
    public function test_invalid_boolean_should_raise_exception()
    {
        $validator = new Bool();
        $this->assertFalse($validator->check('foo'));
    }
    
    public function test_invalid_boolean_values_should_return_false()
    {
        $validator = new Bool();
        $this->assertFalse($validator->validate('foo'));
        $this->assertFalse($validator->validate(123123));
        $this->assertFalse($validator->validate(new \stdClass()));
        $this->assertFalse($validator->validate(array()));
        $this->assertFalse($validator->validate(1));
        $this->assertFalse($validator->validate(0));
        $this->assertFalse($validator->validate(null));
        $this->assertFalse($validator->validate(''));
    }

}

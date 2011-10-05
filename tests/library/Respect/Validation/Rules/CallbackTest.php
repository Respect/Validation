<?php

namespace Respect\Validation\Rules;

class CallbackTest extends \PHPUnit_Framework_TestCase
{

    public function thisIsASampleCallbackUsedInsideThisTest()
    {
        return true;
    }

    public function test_callback_validator_should_return_true_if_callback_returns_true()
    {
        $v = new Callback(function() {
                    return true;
                });
        $this->assertTrue($v->assert('wpoiur'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\CallbackException
     */
    public function test_callback_validator_should_return_false_if_callback_returns_false()
    {
        $v = new Callback(function() {
                    return false;
                });
        $this->assertTrue($v->assert('w poiur'));
    }

    public function test_callback_validator_should_accept_array_callback_definitions()
    {
        $v = new Callback(array($this, 'thisIsASampleCallbackUsedInsideThisTest'));
        $this->assertTrue($v->assert('test'));
    }

    public function test_callback_validator_should_accept_function_names_as_string()
    {
        $v = new Callback('is_string');
        $this->assertTrue($v->assert('test'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function test_invalid_callbacks_should_raise_ComponentException_upon_instantiation()
    {
        $v = new Callback(new \stdClass);
        $this->assertTrue($v->assert('w poiur'));
    }

}
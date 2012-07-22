<?php

namespace Respect\Validation\Rules;

class CallTest extends \PHPUnit_Framework_TestCase
{

    public function thisIsASampleCallbackUsedInsideThisTest()
    {
        return array();
    }

    public function test_callback_validator_should_accept_string_with_function_name()
    {
        $v = new Call('str_split', new Arr);
        $this->assertTrue($v->assert('test'));
    }

    public function test_callback_validator_should_accept_array_callback_definition()
    {
        $v = new Call(array($this, 'thisIsASampleCallbackUsedInsideThisTest'), new Arr);
        $this->assertTrue($v->assert('test'));
    }

    public function test_callback_validator_should_accept_closures()
    {
        $v = new Call(function() {
                    return array();
                }, new Arr);
        $this->assertTrue($v->assert('test'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\CallException
     */
    public function test_callback_failed_should_throw_CallException()
    {
        $v = new Call('strrev', new Arr);
        $this->assertFalse($v->validate('test'));
        $this->assertFalse($v->assert('test'));
    }

}
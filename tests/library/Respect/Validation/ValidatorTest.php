<?php

namespace Respect\Validation;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    function test_static_create_should_return_new_validator() 
    {
        $this->assertInstanceOf('Respect\Validation\Validator', Validator::create());
    }
    
    function test_invalid_rule_class_should_throw_component_exception()
    {
        $this->setExpectedException('Respect\Validation\Exceptions\ComponentException');
        Validator::iDoNotExistSoIShouldThrowException();
    }
    function test_set_template_with_single_validator_should_use_template_as_main_message() {
        try {
            Validator::callback('is_int')->setTemplate('{{name}} is not tasty')->assert('something');
        } catch (\Exception $e) {
            $this->assertEquals('"something" is not tasty', $e->getMainMessage());
        }
    }
    function test_set_template_with_multiple_validators_should_use_template_as_main_message() {
        try {
            Validator::callback('is_int')->between(1,2)->setTemplate('{{name}} is not tasty')->assert('something');
        } catch (\Exception $e) {
            $this->assertEquals('"something" is not tasty', $e->getMainMessage());
        }
    }
}
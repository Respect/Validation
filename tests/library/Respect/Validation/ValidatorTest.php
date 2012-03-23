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
    function test_set_template() {
        try {
            Validator::callback('is_int')->setTemplate('{{name}} is not tasty')->assert('something');
        } catch (\Exception $e) {
            $this->assertEquals('"something" is not tasty', $e->getMainMessage());
        }   
    }
}
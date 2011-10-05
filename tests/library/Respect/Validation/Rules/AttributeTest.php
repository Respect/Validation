<?php

namespace Respect\Validation\Rules;

class PrivClass
{

    private $bar = 'foo';

}

class AttributeTest extends \PHPUnit_Framework_TestCase
{

    public function test_attribute_with_no_extra_validation_should_check_its_presence()
    {
        $validator = new Attribute('bar');
        $obj = new \stdClass;
        $obj->bar = 'foo';
        $this->assertTrue($validator->check($obj));
        $this->assertTrue($validator->validate($obj));
        $this->assertTrue($validator->assert($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\AttributeException
     */
    public function test_absent_attribute_should_raise_AttributeException()
    {
        $validator = new Attribute('bar');
        $obj = new \stdClass;
        $obj->baraaaaa = 'foo';
        $this->assertFalse($validator->validate($obj));
        $this->assertFalse($validator->assert($obj));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function test_absent_attribute_should_raise_AttributeException_on_check()
    {
        $validator = new Attribute('bar');
        $obj = new \stdClass;
        $obj->baraaaaa = 'foo';
        $this->assertFalse($validator->validate($obj));
        $this->assertFalse($validator->check($obj));
    }

    /**
     * @dataProvider providerForInvalidAtrributeNames
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function test_invalid_constructor_arguments_should_throw_ComponentException($attributeName)
    {
        $validator = new Attribute($attributeName);
    }

    public function providerForInvalidAtrributeNames()
    {
        return array(
            array(new \stdClass),
            array(123),
            array('')
        );
    }

    public function test_extra_validator_rules_for_attribute()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator);
        $obj = new \stdClass;
        $obj->bar = 'foo';
        $this->assertTrue($validator->validate($obj));
        $this->assertTrue($validator->assert($obj));
        $this->assertTrue($validator->check($obj));
    }
    
    public function test_extra_validator_rules_for_attribute_should_fail_if_invalid()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator);
        $obj = new \stdClass;
        $obj->bar = 'foo hey this has more than 3 chars';
        $this->assertFalse($validator->validate($obj));
    }
    
    /**
     * @expectedException Respect\Validation\Exceptions\LengthException
     */
    public function test_extra_validator_rules_for_attribute_should_raise_extra_validator_exception_on_check()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator);
        $obj = new \stdClass;
        $obj->bar = 'foo hey this has more than 3 chars';
        $this->assertFalse($validator->check($obj));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\AttributeException
     */
    public function test_extra_validator_rules_for_attribute_should_raise_AttributeException_on_assert()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator);
        $obj = new \stdClass;
        $obj->bar = 'foo hey this has more than 3 chars';
        $this->assertFalse($validator->assert($obj));
    }

    public function test_not_mandatory_attribute_should_not_fail_when_attribute_is_absent()
    {
        $validator = new Attribute('bar', null, false);
        $obj = new \stdClass;
        $this->assertTrue($validator->validate($obj));
    }

    public function test_not_mandatory_attribute_should_not_fail_when_attribute_is_absent_with_extra_validator()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator, false);
        $obj = new \stdClass;
        $this->assertTrue($validator->validate($obj));
    }

    public function test_private_attribute_should_also_be_checked()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator);
        $obj = new PrivClass;
        $this->assertTrue($validator->assert($obj));
    }

    public function test_private_attribute_should_fail_if_not_valid()
    {
        $subValidator = new Length(33333, 888888);
        $validator = new Attribute('bar', $subValidator);
        $obj = new PrivClass;
        $this->assertFalse($validator->validate($obj));
    }

}
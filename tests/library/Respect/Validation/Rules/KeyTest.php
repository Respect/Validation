<?php

namespace Respect\Validation\Rules;

class KeyTest extends \PHPUnit_Framework_TestCase
{

    public function test_array_with_present_key_should_return_true()
    {
        $validator = new Key('bar');
        $obj = array();
        $obj['bar'] = 'foo';
        $this->assertTrue($validator->assert($obj));
        $this->assertTrue($validator->check($obj));
        $this->assertTrue($validator->validate($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\KeyException
     */
    public function test_array_with_absent_key_should_throw_KeyException()
    {
        $validator = new Key('bar');
        $obj = array();
        $obj['baraaaaaa'] = 'foo';
        $this->assertTrue($validator->assert($obj));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\KeyException
     */
    public function test_not_array_should_throw_KeyException()
    {
        $validator = new Key('bar');
        $obj = 123;
        $this->assertFalse($validator->assert($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function test_invalid_constructor_parameters_should_throw_ComponentException_upon_instantiation()
    {
        $validator = new Key(array('invalid'));
    }

    public function test_extra_validator_should_validate_key()
    {
        $subValidator = new Length(1, 3);
        $validator = new Key('bar', $subValidator);
        $obj = array();
        $obj['bar'] = 'foo';
        $this->assertTrue($validator->assert($obj));
    }

    public function test_not_mandatory_extra_validator_should_pass_with_absent_key()
    {
        $subValidator = new Length(1, 3);
        $validator = new Key('bar', $subValidator, false);
        $obj = array();
        $this->assertTrue($validator->validate($obj));
    }

}
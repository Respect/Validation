<?php

namespace Respect\Validation\Rules;

use DateTime;

class ZendTest extends \PHPUnit_Framework_TestCase
{

    public function test_zend_dependency()
    {
        $this->assertTrue(
            class_exists('\Zend\Validator\Date'),
            'Zend Framework 2 Validator not installed.'
        );
    }

    /**
     * @depends test_zend_dependency
     */
    public function test_constructor_with_validator_name()
    {
        $v = new Zend('Date');
        $this->assertAttributeInstanceOf(
            $instanceOf = 'Zend\Validator\ValidatorInterface',
            $attribute  = 'zendValidator',
            $instance   = $v
        );
    }

    /**
     * @depends test_constructor_with_validator_name
     */
    public function test_constructor_with_validator_class_name()
    {
        $v = new Zend('Zend\Validator\Date');
        $this->assertAttributeInstanceOf(
            $instanceOf = 'Zend\Validator\ValidatorInterface',
            $attribute  = 'zendValidator',
            $instance   = $v
        );
    }

    /**
     * @depends test_zend_dependency
     */
    public function test_constructor_with_zend_validator_instance()
    {
        $zendInstance = new \Zend\Validator\Date;
        $v            = new Zend($zendInstance);
        $this->assertAttributeSame(
            $expected   = $zendInstance,
            $attribute  = 'zendValidator',
            $instance   = $v
        );
    }

    /**
     * @depends test_zend_dependency
     * @depends test_constructor_with_zend_validator_instance
     */
    public function test_userland_validator_extending_zend_interface()
    {
        $v = new Zend(new MyValidator);
        $this->assertAttributeInstanceOf(
            $instanceOf = 'Zend\Validator\ValidatorInterface',
            $attribute  = 'zendValidator',
            $instance   = $v
        );
    }

    /**
     * @depends test_zend_dependency
     */
    public function test_constructor_with_zend_validator_partial_namespace()
    {
        $v = new Zend('Sitemap\Lastmod');
        $this->assertAttributeInstanceOf(
            $instanceOf = 'Zend\Validator\ValidatorInterface',
            $attribute  = 'zendValidator',
            $instance   = $v
        );
    }

    /**
     * @depends test_constructor_with_validator_name
     * @depends test_constructor_with_zend_validator_partial_namespace
     */
    public function test_constructor_with_validator_name_and_params()
    {
        $zendValidatorName   = 'StringLength';
        $zendValidatorParams = array('min' => 10, 'max' => 25);
        $v = new Zend($zendValidatorName, $zendValidatorParams);
        $this->assertTrue(
            $v->validate('12345678901'),
            'The value should be valid for Zend\'s validator'
        );
    }

    /**
     * @depends test_constructor_with_validator_name
     */
    public function test_zend_date_validator_with_respect_methods()
    {
        $v    = new Zend('Date');
        $date = new DateTime;
        $this->assertTrue($v->validate($date));
        $this->assertTrue($v->assert($date));
    }

    /**
     * @depends test_constructor_with_validator_name
     * @depends test_zend_date_validator_with_respect_methods
     * @expectedException Respect\Validation\Exceptions\ZendException
     */
    public function test_respect_exception_for_failed_validation()
    {
        $v = new Zend('Date');
        $notValid = 'a';
        $this->assertFalse(
            $v->validate($notValid),
            'The validator returned true for an invalid value, this won\'t cause an exception later on.'
        );
        $this->assertFalse(
            $v->assert($notValid)
        );
    }

    /**
     * @depends test_constructor_with_validator_name
     * @depends test_constructor_with_validator_name_and_params
     * @depends test_zend_date_validator_with_respect_methods
     * @expectedException Respect\Validation\Exceptions\ZendException
     */
    public function testParamsNot()
    {
        $v = new Zend('StringLength', array('min' => 10, 'max' => 25));
        $this->assertFalse($v->assert('aw'));
    }

}

// Stubs
if (class_exists('\Zend\Validator\Date')) {
    class MyValidator extends \Zend\Validator\Date
    {
    }
}

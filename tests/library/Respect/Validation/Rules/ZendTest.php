<?php
namespace Respect\Validation\Rules;

use DateTime;

class ZendTest extends \PHPUnit_Framework_TestCase
{
    public function testZendDependency()
    {
        if (false === class_exists('\Zend\Validator\Date')) {
            $this->markTestSkipped('Zend Framework 2 Validator not installed.');
        }
    }

    /**
     * @depends testZendDependency
     */
    public function testConstructorWithValidatorName()
    {
        $v = new Zend('Date');
        $this->assertAttributeInstanceOf(
            $instanceOf = 'Zend\Validator\ValidatorInterface',
            $attribute  = 'zendValidator',
            $instance   = $v
        );
    }

    /**
     * @depends testConstructorWithValidatorName
     */
    public function testConstructorWithValidatorClassName()
    {
        $v = new Zend('Zend\Validator\Date');
        $this->assertAttributeInstanceOf(
            $instanceOf = 'Zend\Validator\ValidatorInterface',
            $attribute  = 'zendValidator',
            $instance   = $v
        );
    }

    /**
     * @depends testZendDependency
     */
    public function testConstructorWithZendValidatorInstance()
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
     * @depends testZendDependency
     * @depends testConstructorWithZendValidatorInstance
     */
    public function testUserlandValidatorExtendingZendInterface()
    {
        $v = new Zend(new MyValidator);
        $this->assertAttributeInstanceOf(
            $instanceOf = 'Zend\Validator\ValidatorInterface',
            $attribute  = 'zendValidator',
            $instance   = $v
        );
    }

    /**
     * @depends testZendDependency
     */
    public function testConstructorWithZendValidatorPartialNamespace()
    {
        $v = new Zend('Sitemap\Lastmod');
        $this->assertAttributeInstanceOf(
            $instanceOf = 'Zend\Validator\ValidatorInterface',
            $attribute  = 'zendValidator',
            $instance   = $v
        );
    }

    /**
     * @depends testConstructorWithValidatorName
     * @depends testConstructorWithZendValidatorPartialNamespace
     */
    public function testConstructorWithValidatorName_and_params()
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
     * @depends testConstructorWithValidatorName
     */
    public function testZendDateValidatorWithRespectMethods()
    {
        $v    = new Zend('Date');
        $date = new DateTime;
        $this->assertTrue($v->validate($date));
        $this->assertTrue($v->assert($date));
    }

    /**
     * @depends testConstructorWithValidatorName
     * @depends testZendDateValidatorWithRespectMethods
     * @expectedException Respect\Validation\Exceptions\ZendException
     */
    public function testRespectExceptionForFailedValidation()
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
     * @depends testConstructorWithValidatorName
     * @depends testConstructorWithValidatorName_and_params
     * @depends testZendDateValidatorWithRespectMethods
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


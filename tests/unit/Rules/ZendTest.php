<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use DateTime;
use Zend\Validator\Date as ZendDate;
use Zend\Validator\ValidatorInterface;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Zend
 * @covers \Respect\Validation\Exceptions\ZendException
 */
class ZendTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorWithValidatorName()
    {
        $v = new Zend('Date');
        $this->assertAttributeInstanceOf(
            $instanceOf = ValidatorInterface::class,
            $attribute = 'zendValidator',
            $instance = $v
        );
    }

    /**
     * @depends testConstructorWithValidatorName
     */
    public function testConstructorWithValidatorClassName()
    {
        $v = new Zend(ZendDate::class);
        $this->assertAttributeInstanceOf(
            $instanceOf = ValidatorInterface::class,
            $attribute = 'zendValidator',
            $instance = $v
        );
    }

    public function testConstructorWithZendValidatorInstance()
    {
        $zendInstance = new ZendDate();
        $v = new Zend($zendInstance);
        $this->assertAttributeSame(
            $expected = $zendInstance,
            $attribute = 'zendValidator',
            $instance = $v
        );
    }

    /**
     * @depends testConstructorWithZendValidatorInstance
     */
    public function testUserlandValidatorExtendingZendInterface()
    {
        $v = new Zend(new MyValidator());
        $this->assertAttributeInstanceOf(
            $instanceOf = ValidatorInterface::class,
            $attribute = 'zendValidator',
            $instance = $v
        );
    }

    public function testConstructorWithZendValidatorPartialNamespace()
    {
        $v = new Zend('Sitemap\Lastmod');
        $this->assertAttributeInstanceOf(
            $instanceOf = ValidatorInterface::class,
            $attribute = 'zendValidator',
            $instance = $v
        );
    }

    /**
     * @depends testConstructorWithValidatorName
     * @depends testConstructorWithZendValidatorPartialNamespace
     */
    public function testConstructorWithValidatorName_and_params()
    {
        $zendValidatorName = 'StringLength';
        $zendValidatorParams = ['min' => 10, 'max' => 25];
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
        $v = new Zend('Date');
        $date = new DateTime();
        $this->assertTrue($v->validate($date));
        $this->assertTrue($v->assert($date));
    }

    /**
     * @depends testConstructorWithValidatorName
     * @depends testZendDateValidatorWithRespectMethods
     * @expectedException \Respect\Validation\Exceptions\ZendException
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
     * @expectedException \Respect\Validation\Exceptions\ZendException
     */
    public function testParamsNot()
    {
        $v = new Zend('StringLength', ['min' => 10, 'max' => 25]);
        $this->assertFalse($v->assert('aw'));
    }
}

// Stubs
if (class_exists(ZendDate::class)) {
    class MyValidator extends ZendDate
    {
    }
}

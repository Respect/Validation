<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime;
use PHPUnit\Framework\TestCase;
use Zend\Validator\Date as ZendDate;
use Zend\Validator\ValidatorInterface;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Zend
 * @covers \Respect\Validation\Exceptions\ZendException
 */
class ZendTest extends TestCase
{
    public function testConstructorWithValidatorName(): void
    {
        $v = new Zend('Date');
        self::assertAttributeInstanceOf(
            $instanceOf = ValidatorInterface::class,
            $attribute = 'zendValidator',
            $instance = $v
        );
    }

    /**
     * @depends testConstructorWithValidatorName
     */
    public function testConstructorWithValidatorClassName(): void
    {
        $v = new Zend(ZendDate::class);
        self::assertAttributeInstanceOf(
            $instanceOf = ValidatorInterface::class,
            $attribute = 'zendValidator',
            $instance = $v
        );
    }

    public function testConstructorWithZendValidatorInstance(): void
    {
        $zendInstance = new ZendDate();
        $v = new Zend($zendInstance);
        self::assertAttributeSame(
            $expected = $zendInstance,
            $attribute = 'zendValidator',
            $instance = $v
        );
    }

    /**
     * @depends testConstructorWithZendValidatorInstance
     */
    public function testUserlandValidatorExtendingZendInterface(): void
    {
        $v = new Zend(new MyValidator());
        self::assertAttributeInstanceOf(
            $instanceOf = ValidatorInterface::class,
            $attribute = 'zendValidator',
            $instance = $v
        );
    }

    public function testConstructorWithZendValidatorPartialNamespace(): void
    {
        $v = new Zend('Sitemap\Lastmod');
        self::assertAttributeInstanceOf(
            $instanceOf = ValidatorInterface::class,
            $attribute = 'zendValidator',
            $instance = $v
        );
    }

    /**
     * @depends testConstructorWithValidatorName
     * @depends testConstructorWithZendValidatorPartialNamespace
     */
    public function testConstructorWithValidatorName_and_params(): void
    {
        $zendValidatorName = 'StringLength';
        $zendValidatorParams = ['min' => 10, 'max' => 25];
        $v = new Zend($zendValidatorName, $zendValidatorParams);
        self::assertTrue(
            $v->validate('12345678901'),
            'The value should be valid for Zend\'s validator'
        );
    }

    /**
     * @depends testConstructorWithValidatorName
     */
    public function testZendDateValidatorWithRespectMethods(): void
    {
        $v = new Zend('Date');
        $date = new DateTime();
        self::assertTrue($v->validate($date));
        self::assertTrue($v->assert($date));
    }

    /**
     * @depends testConstructorWithValidatorName
     * @depends testZendDateValidatorWithRespectMethods
     * @expectedException \Respect\Validation\Exceptions\ZendException
     */
    public function testRespectExceptionForFailedValidation(): void
    {
        $v = new Zend('Date');
        $notValid = 'a';
        self::assertFalse(
            $v->validate($notValid),
            'The validator returned true for an invalid value, this won\'t cause an exception later on.'
        );
        self::assertFalse(
            $v->assert($notValid)
        );
    }

    /**
     * @depends testConstructorWithValidatorName
     * @depends testConstructorWithValidatorName_and_params
     * @depends testZendDateValidatorWithRespectMethods
     * @expectedException \Respect\Validation\Exceptions\ZendException
     */
    public function testParamsNot(): void
    {
        $v = new Zend('StringLength', ['min' => 10, 'max' => 25]);
        self::assertFalse($v->assert('aw'));
    }
}

// Stubs
if (class_exists(ZendDate::class)) {
    class MyValidator extends ZendDate
    {
    }
}

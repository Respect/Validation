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
 * @covers \Respect\Validation\Exceptions\ZendException
 * @covers \Respect\Validation\Rules\Zend
 */
class ZendTest extends TestCase
{
    /**
     * @test
     */
    public function constructorWithValidatorName(): void
    {
        $v = new Zend('Date');
        self::assertAttributeInstanceOf(
            $instanceOf = ValidatorInterface::class,
            $attribute = 'zendValidator',
            $instance = $v
        );
    }

    /**
     * @depends constructorWithValidatorName
     *
     * @test
     */
    public function constructorWithValidatorClassName(): void
    {
        $v = new Zend(ZendDate::class);
        self::assertAttributeInstanceOf(
            $instanceOf = ValidatorInterface::class,
            $attribute = 'zendValidator',
            $instance = $v
        );
    }

    /**
     * @test
     */
    public function constructorWithZendValidatorInstance(): void
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
     * @depends constructorWithZendValidatorInstance
     *
     * @test
     */
    public function userlandValidatorExtendingZendInterface(): void
    {
        $v = new Zend(new MyValidator());
        self::assertAttributeInstanceOf(
            $instanceOf = ValidatorInterface::class,
            $attribute = 'zendValidator',
            $instance = $v
        );
    }

    /**
     * @test
     */
    public function constructorWithZendValidatorPartialNamespace(): void
    {
        $v = new Zend('Sitemap\Lastmod');
        self::assertAttributeInstanceOf(
            $instanceOf = ValidatorInterface::class,
            $attribute = 'zendValidator',
            $instance = $v
        );
    }

    /**
     * @depends constructorWithValidatorName
     * @depends constructorWithZendValidatorPartialNamespace
     *
     * @test
     */
    public function constructorWithValidatorName_and_params(): void
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
     * @depends constructorWithValidatorName
     *
     * @test
     */
    public function zendDateValidatorWithRespectMethods(): void
    {
        $v = new Zend('Date');
        $date = new DateTime();
        self::assertTrue($v->validate($date));
        $v->assert($date);
    }

    /**
     * @depends constructorWithValidatorName
     * @depends zendDateValidatorWithRespectMethods
     * @expectedException \Respect\Validation\Exceptions\ZendException
     *
     * @test
     */
    public function respectExceptionForFailedValidation(): void
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
     * @depends constructorWithValidatorName
     * @depends constructorWithValidatorName_and_params
     * @depends zendDateValidatorWithRespectMethods
     * @expectedException \Respect\Validation\Exceptions\ZendException
     *
     * @test
     */
    public function paramsNot(): void
    {
        $v = new Zend('StringLength', ['min' => 10, 'max' => 25]);
        $v->assert('aw');
    }
}

// Stubs
if (class_exists(ZendDate::class)) {
    class MyValidator extends ZendDate
    {
    }
}

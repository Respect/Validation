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

class PrivMethodClass
{
    private $bar = 'foo';

    public function getBar()
    {
        return $this->bar;
    }

    public function setBar($bar)
    {
        $this->bar = $bar;
    }

    private function getPrivateBar()
    {
        return $this->bar;
    }
}

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Method
 * @covers Respect\Validation\Exceptions\MethodException
 */
class MethodTest extends \PHPUnit_Framework_TestCase
{
    public function testMethodWithNoExtraValidationShouldCheckItsPresence()
    {
        $validator = new Method('getBar');
        $obj = new PrivMethodClass();
        $this->assertTrue($validator->check($obj));
        $this->assertTrue($validator->__invoke($obj));
        $this->assertTrue($validator->assert($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\MethodException
     */
    public function testAbsentMethodShouldRaiseMethodException()
    {
        $validator = new Method('getMadeupBar');
        $obj = new PrivMethodClass();
        $this->assertFalse($validator->__invoke($obj));
        $this->assertFalse($validator->assert($obj));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testAbsentMethodShouldRaiseMethodException_on_check()
    {
        $validator = new Method('getMadeupBar');
        $obj = new PrivMethodClass();
        $this->assertFalse($validator->__invoke($obj));
        $this->assertFalse($validator->check($obj));
    }

    /**
     * @dataProvider providerForInvalidMethodNames
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorArgumentsShouldThrowComponentException($methodName)
    {
        $validator = new Method($methodName);
    }

    public function providerForInvalidMethodNames()
    {
        return [
            [new \stdClass()],
            [123],
            [''],
        ];
    }

    public function testExtraValidatorRulesForMethod()
    {
        $subValidator = new Length(1, 3);
        $validator = new Method('getBar', $subValidator);
        $obj = new PrivMethodClass();
        $this->assertTrue($validator->__invoke($obj));
        $this->assertTrue($validator->assert($obj));
        $this->assertTrue($validator->check($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\MethodException
     */
    public function testShouldNotValidateEmptyString()
    {
        $subValidator = new Length(1, 3);
        $validator = new Method('getBar', $subValidator);

        $this->assertFalse($validator->__invoke(''));
        $validator->assert('');
    }

    public function testExtraValidatorRulesForMethod_should_fail_if_invalid()
    {
        $subValidator = new Length(1, 3);
        $validator = new Method('getBar', $subValidator);
        $obj = new PrivMethodClass();
        $obj->setBar('foo hey this has more than 3 chars');
        $this->assertFalse($validator->__invoke($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\LengthException
     */
    public function testExtraValidatorRulesForMethod_should_raise_extra_validator_exception_on_check()
    {
        $subValidator = new Length(1, 3);
        $validator = new Method('getBar', $subValidator);
        $obj = new PrivMethodClass();
        $obj->setBar('foo hey this has more than 3 chars');
        $this->assertFalse($validator->check($obj));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\MethodException
     */
    public function testExtraValidatorRulesForMethod_should_raise_MethodException_on_assert()
    {
        $subValidator = new Length(1, 3);
        $validator = new Method('getBar', $subValidator);
        $obj = new PrivMethodClass();
        $obj->setBar('foo hey this has more than 3 chars');
        $this->assertFalse($validator->assert($obj));
    }

    public function testNotMandatoryMethodShouldNotFailWhenMethodIsAbsent()
    {
        $validator = new Method('getMadeupBar', null, false);
        $obj = new PrivMethodClass();
        $this->assertTrue($validator->__invoke($obj));
    }

    public function testNotMandatoryMethodShouldNotFailWhenMethodIsAbsent_with_extra_validator()
    {
        $subValidator = new Length(1, 3);
        $validator = new Method('getMadeupBar', $subValidator, false);
        $obj = new PrivMethodClass();
        $this->assertTrue($validator->__invoke($obj));
    }

    public function testPrivateMethodShouldAlsoBeChecked()
    {
        $subValidator = new Length(1, 3);
        $validator = new Method('getPrivateBar', $subValidator);
        $obj = new PrivMethodClass();
        $this->assertTrue($validator->assert($obj));
    }

    public function testPrivateMethodShouldFailIfNotValid()
    {
        $subValidator = new Length(33333, 888888);
        $validator = new Method('getPrivateBar', $subValidator);
        $obj = new PrivMethodClass();
        $this->assertFalse($validator->__invoke($obj));
    }
}


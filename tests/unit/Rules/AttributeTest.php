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

use Respect\Validation\TestCase;

class PrivClass
{
    private $bar = 'foo';
}

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Attribute
 * @covers Respect\Validation\Exceptions\AttributeException
 */
class AttributeTest extends TestCase
{
    public function testAttributeWithNoExtraValidationShouldCheckItsPresence()
    {
        $validator = new Attribute('bar');
        $obj = new \stdClass();
        $obj->bar = 'foo';
        $this->assertTrue($validator->check($obj));
        $this->assertTrue($validator->__invoke($obj));
        $this->assertTrue($validator->assert($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\AttributeException
     */
    public function testAbsentAttributeShouldRaiseAttributeException()
    {
        $validator = new Attribute('bar');
        $obj = new \stdClass();
        $obj->baraaaaa = 'foo';
        $this->assertFalse($validator->__invoke($obj));
        $this->assertFalse($validator->assert($obj));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testAbsentAttributeShouldRaiseAttributeException_on_check()
    {
        $validator = new Attribute('bar');
        $obj = new \stdClass();
        $obj->baraaaaa = 'foo';
        $this->assertFalse($validator->__invoke($obj));
        $this->assertFalse($validator->check($obj));
    }

    /**
     * @dataProvider providerForInvalidAttributeNames
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorArgumentsShouldThrowComponentException($attributeName)
    {
        $validator = new Attribute($attributeName);
    }

    public function providerForInvalidAttributeNames()
    {
        return [
            [new \stdClass()],
            [123],
            [''],
        ];
    }

    public function testExtraValidatorRulesForAttribute()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator);
        $obj = new \stdClass();
        $obj->bar = 'foo';
        $this->assertTrue($validator->__invoke($obj));
        $this->assertTrue($validator->assert($obj));
        $this->assertTrue($validator->check($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\AttributeException
     */
    public function testShouldNotValidateEmptyString()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator);
        $obj = new \stdClass();
        $obj->bar = 'foo';

        $this->assertFalse($validator->__invoke(''));
        $validator->assert('');
    }

    public function testExtraValidatorRulesForAttribute_should_fail_if_invalid()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator);
        $obj = new \stdClass();
        $obj->bar = 'foo hey this has more than 3 chars';
        $this->assertFalse($validator->__invoke($obj));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\LengthException
     */
    public function testExtraValidatorRulesForAttribute_should_raise_extra_validator_exception_on_check()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator);
        $obj = new \stdClass();
        $obj->bar = 'foo hey this has more than 3 chars';
        $this->assertFalse($validator->check($obj));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\AttributeException
     */
    public function testExtraValidatorRulesForAttribute_should_raise_AttributeException_on_assert()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator);
        $obj = new \stdClass();
        $obj->bar = 'foo hey this has more than 3 chars';
        $this->assertFalse($validator->assert($obj));
    }

    public function testNotMandatoryAttributeShouldNotFailWhenAttributeIsAbsent()
    {
        $validator = new Attribute('bar', null, false);
        $obj = new \stdClass();
        $this->assertTrue($validator->__invoke($obj));
    }

    public function testNotMandatoryAttributeShouldNotFailWhenAttributeIsAbsent_with_extra_validator()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator, false);
        $obj = new \stdClass();
        $this->assertTrue($validator->__invoke($obj));
    }

    public function testPrivateAttributeShouldAlsoBeChecked()
    {
        $subValidator = new Length(1, 3);
        $validator = new Attribute('bar', $subValidator);
        $obj = new PrivClass();
        $this->assertTrue($validator->assert($obj));
    }

    public function testPrivateAttributeShouldFailIfNotValid()
    {
        $subValidator = new Length(33333, 888888);
        $validator = new Attribute('bar', $subValidator);
        $obj = new PrivClass();
        $this->assertFalse($validator->__invoke($obj));
    }
}

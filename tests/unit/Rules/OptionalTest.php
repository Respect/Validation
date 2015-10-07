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

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Optional
 * @covers Respect\Validation\Exceptions\OptionalException
 */
class OptionalTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldAcceptInstanceOfValidatobleOnConstructor()
    {
        $validatable = $this->getMock('Respect\\Validation\\Validatable');
        $rule = new Optional($validatable);

        $this->assertSame($validatable, $rule->getValidatable());
    }

    public function testShouldAcceptOptionalValuesOnConstructor()
    {
        $validatable = $this->getMock('Respect\\Validation\\Validatable');
        $optionalValues = array(null, '', ' ', '0');
        $rule = new Optional($validatable, $optionalValues);

        $this->assertSame($optionalValues, $rule->optionalValues);
    }

    public function testShouldHaveDefaultOptionalValues()
    {
        $validatable = $this->getMock('Respect\\Validation\\Validatable');
        $expectedOptionalValues = array(null, '');
        $rule = new Optional($validatable);

        $this->assertSame($expectedOptionalValues, $rule->optionalValues);
    }

    public function testShouldNotValidateRuleWhenInputIsOptional()
    {
        $validatable = $this->getMock('Respect\\Validation\\Validatable');
        $validatable
            ->expects($this->never())
            ->method('validate');

        $rule = new Optional($validatable);

        $this->assertTrue($rule->validate(''));
    }

    public function testShouldValidateRuleWhenInputIsNotOptional()
    {
        $input = 'foo';

        $validatable = $this->getMock('Respect\\Validation\\Validatable');
        $validatable
            ->expects($this->once())
            ->method('validate')
            ->with($input)
            ->will($this->returnValue(true));

        $rule = new Optional($validatable);

        $this->assertTrue($rule->validate($input));
    }

    public function testShouldNotAssertRuleWhenInputIsOptional()
    {
        $validatable = $this->getMock('Respect\\Validation\\Validatable');
        $validatable
            ->expects($this->never())
            ->method('assert');

        $rule = new Optional($validatable);

        $this->assertTrue($rule->assert(''));
    }

    public function testShouldAssertRuleWhenInputIsNotOptional()
    {
        $input = 'foo';

        $validatable = $this->getMock('Respect\\Validation\\Validatable');
        $validatable
            ->expects($this->once())
            ->method('assert')
            ->with($input)
            ->will($this->returnValue(true));

        $rule = new Optional($validatable);

        $this->assertTrue($rule->assert($input));
    }

    public function testShouldNotCheckRuleWhenInputIsOptional()
    {
        $validatable = $this->getMock('Respect\\Validation\\Validatable');
        $validatable
            ->expects($this->never())
            ->method('check');

        $rule = new Optional($validatable);

        $this->assertTrue($rule->check(''));
    }

    public function testShouldCheckRuleWhenInputIsNotOptional()
    {
        $input = 'foo';

        $validatable = $this->getMock('Respect\\Validation\\Validatable');
        $validatable
            ->expects($this->once())
            ->method('check')
            ->with($input)
            ->will($this->returnValue(true));

        $rule = new Optional($validatable);

        $this->assertTrue($rule->check($input));
    }
}

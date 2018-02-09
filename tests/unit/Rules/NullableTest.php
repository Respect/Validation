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

use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Nullable
 */
class NullableTest extends TestCase
{
    public function providerForNotNullable()
    {
        return [
            [''],
            [1],
            [[]],
            [' '],
            [0],
            ['0'],
            [0],
            ['0.0'],
            [false],
            [['']],
            [[' ']],
            [[0]],
            [['0']],
            [[false]],
            [[[''], [0]]],
            [new stdClass()],
        ];
    }

    public function testShouldAcceptInstanceOfValidatobleOnConstructor()
    {
        $validatable = $this->createMock('Respect\\Validation\\Validatable');
        $rule = new Nullable($validatable);

        $this->assertSame($validatable, $rule->getValidatable());
    }

    public function testShouldNotValidateRuleWhenInputIsNull()
    {
        $validatable = $this->createMock('Respect\\Validation\\Validatable');
        $validatable
            ->expects($this->never())
            ->method('validate');

        $rule = new Nullable($validatable);

        $this->assertTrue($rule->validate(null));
    }

    /**
     * @dataProvider providerForNotNullable
     */
    public function testShouldValidateRuleWhenInputIsNotNullable($input)
    {
        $validatable = $this->createMock('Respect\\Validation\\Validatable');
        $validatable
            ->expects($this->once())
            ->method('validate')
            ->with($input)
            ->will($this->returnValue(true));

        $rule = new Nullable($validatable);

        $this->assertTrue($rule->validate($input));
    }

    public function testShouldNotAssertRuleWhenInputIsNull()
    {
        $validatable = $this->createMock('Respect\\Validation\\Validatable');
        $validatable
            ->expects($this->never())
            ->method('assert');

        $rule = new Nullable($validatable);

        $this->assertTrue($rule->assert(null));
    }

    public function testShouldAssertRuleWhenInputIsNotNullable()
    {
        $input = 'foo';

        $validatable = $this->createMock('Respect\\Validation\\Validatable');
        $validatable
            ->expects($this->once())
            ->method('assert')
            ->with($input)
            ->will($this->returnValue(true));

        $rule = new Nullable($validatable);

        $this->assertTrue($rule->assert($input));
    }

    public function testShouldNotCheckRuleWhenInputIsNull()
    {
        $validatable = $this->createMock('Respect\\Validation\\Validatable');
        $validatable
            ->expects($this->never())
            ->method('check');

        $rule = new Nullable($validatable);

        $this->assertTrue($rule->check(null));
    }

    public function testShouldCheckRuleWhenInputIsNotNullable()
    {
        $input = 'foo';

        $validatable = $this->createMock('Respect\\Validation\\Validatable');
        $validatable
            ->expects($this->once())
            ->method('check')
            ->with($input)
            ->will($this->returnValue(true));

        $rule = new Nullable($validatable);

        $this->assertTrue($rule->check($input));
    }
}

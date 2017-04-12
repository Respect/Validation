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

use Respect\Validation\Validatable;
use stdClass;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Optional
 */
class OptionalTest extends \PHPUnit_Framework_TestCase
{
    public function providerForOptional()
    {
        return [
            [null],
            [''],
        ];
    }

    public function providerForNotOptional()
    {
        return [
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
        $validatable = $this->createMock(Validatable::class);
        $rule = new Optional($validatable);

        $this->assertSame($validatable, $rule->getValidatable());
    }

    /**
     * @dataProvider providerForOptional
     */
    public function testShouldNotValidateRuleWhenInputIsOptional($input)
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->never())
            ->method('validate');

        $rule = new Optional($validatable);

        $this->assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForNotOptional
     */
    public function testShouldValidateRuleWhenInputIsNotOptional($input)
    {
        $validatable = $this->createMock(Validatable::class);
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
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->never())
            ->method('assert');

        $rule = new Optional($validatable);

        $this->assertTrue($rule->assert(''));
    }

    public function testShouldAssertRuleWhenInputIsNotOptional()
    {
        $input = 'foo';

        $validatable = $this->createMock(Validatable::class);
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
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->never())
            ->method('check');

        $rule = new Optional($validatable);

        $this->assertTrue($rule->check(''));
    }

    public function testShouldCheckRuleWhenInputIsNotOptional()
    {
        $input = 'foo';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->once())
            ->method('check')
            ->with($input)
            ->will($this->returnValue(true));

        $rule = new Optional($validatable);

        $this->assertTrue($rule->check($input));
    }
}

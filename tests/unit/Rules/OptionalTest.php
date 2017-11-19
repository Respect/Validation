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

use PHPUnit\Framework\TestCase;
use Respect\Validation\Validatable;
use stdClass;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Optional
 */
class OptionalTest extends TestCase
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

    public function testShouldAcceptInstanceOfValidatobleOnConstructor(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $rule = new Optional($validatable);

        self::assertSame($validatable, $rule->getValidatable());
    }

    /**
     * @dataProvider providerForOptional
     */
    public function testShouldNotValidateRuleWhenInputIsOptional($input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->never())
            ->method('validate');

        $rule = new Optional($validatable);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForNotOptional
     */
    public function testShouldValidateRuleWhenInputIsNotOptional($input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->once())
            ->method('validate')
            ->with($input)
            ->will($this->returnValue(true));

        $rule = new Optional($validatable);

        self::assertTrue($rule->validate($input));
    }

    public function testShouldNotAssertRuleWhenInputIsOptional(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->never())
            ->method('assert');

        $rule = new Optional($validatable);

        self::assertTrue($rule->assert(''));
    }

    public function testShouldAssertRuleWhenInputIsNotOptional(): void
    {
        $input = 'foo';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->once())
            ->method('assert')
            ->with($input)
            ->will($this->returnValue(true));

        $rule = new Optional($validatable);

        self::assertTrue($rule->assert($input));
    }

    public function testShouldNotCheckRuleWhenInputIsOptional(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->never())
            ->method('check');

        $rule = new Optional($validatable);

        self::assertTrue($rule->check(''));
    }

    public function testShouldCheckRuleWhenInputIsNotOptional(): void
    {
        $input = 'foo';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->once())
            ->method('check')
            ->with($input)
            ->will($this->returnValue(true));

        $rule = new Optional($validatable);

        self::assertTrue($rule->check($input));
    }
}

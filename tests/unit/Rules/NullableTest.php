<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\TestCase;
use Respect\Validation\Validatable;
use stdClass;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\Nullable
 */
final class NullableTest extends TestCase
{
    /**
     * @test
     */
    public function shouldNotValidateRuleWhenInputIsNull(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('validate');

        $rule = new Nullable($validatable);

        self::assertTrue($rule->validate(null));
    }

    /**
     * @dataProvider providerForNotNullable
     * @test
     */
    public function shouldValidateRuleWhenInputIsNotNullable(mixed $input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('validate')
            ->with($input)
            ->will(self::returnValue(true));

        $rule = new Nullable($validatable);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @test
     */
    public function shouldNotAssertRuleWhenInputIsNull(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('assert');

        $rule = new Nullable($validatable);
        $rule->assert(null);
    }

    /**
     * @test
     * @dataProvider providerForNotNullable
     */
    public function shouldAssertRuleWhenInputIsNotNullable(mixed $input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('assert')
            ->with($input)
            ->will(self::returnValue(true));

        $rule = new Nullable($validatable);
        $rule->assert($input);
    }

    /**
     * @test
     */
    public function shouldNotCheckRuleWhenInputIsNull(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('check');

        $rule = new Nullable($validatable);
        $rule->check(null);
    }

    /**
     * @test
     * @dataProvider providerForNotNullable
     */
    public function shouldCheckRuleWhenInputIsNotNullable(mixed $input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('check')
            ->with($input)
            ->will(self::returnValue(true));

        $rule = new Nullable($validatable);
        $rule->check($input);
    }

    /**
     * @return mixed[][]
     */
    public static function providerForNotNullable(): array
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
}

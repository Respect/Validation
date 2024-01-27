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
 *
 * @covers \Respect\Validation\Rules\Optional
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class OptionalTest extends TestCase
{
    /**
     * @dataProvider providerForOptional
     *
     * @test
     *
     * @param mixed $input
     */
    public function shouldNotValidateRuleWhenInputIsOptional($input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('validate');

        $rule = new Optional($validatable);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForNotOptional
     *
     * @test
     *
     * @param mixed $input
     */
    public function shouldValidateRuleWhenInputIsNotOptional($input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('validate')
            ->with($input)
            ->will(self::returnValue(true));

        $rule = new Optional($validatable);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @test
     */
    public function shouldNotAssertRuleWhenInputIsOptional(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('assert');

        $rule = new Optional($validatable);

        $rule->assert('');
    }

    /**
     * @test
     */
    public function shouldAssertRuleWhenInputIsNotOptional(): void
    {
        $input = 'foo';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('assert')
            ->with($input)
            ->will(self::returnValue(true));

        $rule = new Optional($validatable);

        $rule->assert($input);
    }

    /**
     * @test
     */
    public function shouldNotCheckRuleWhenInputIsOptional(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('check');

        $rule = new Optional($validatable);

        $rule->check('');
    }

    /**
     * @test
     */
    public function shouldCheckRuleWhenInputIsNotOptional(): void
    {
        $input = 'foo';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('check')
            ->with($input)
            ->will(self::returnValue(true));

        $rule = new Optional($validatable);

        $rule->check($input);
    }

    /**
     * @return mixed[][]
     */
    public static function providerForOptional(): array
    {
        return [
            [null],
            [''],
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function providerForNotOptional(): array
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
}

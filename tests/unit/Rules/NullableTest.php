<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validatable;
use stdClass;

#[Group('rule')]
#[CoversClass(Nullable::class)]
final class NullableTest extends TestCase
{
    #[Test]
    public function shouldNotValidateRuleWhenInputIsNull(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('validate');

        $rule = new Nullable($validatable);

        self::assertTrue($rule->validate(null));
    }

    #[Test]
    #[DataProvider('providerForNotNullable')]
    public function shouldValidateRuleWhenInputIsNotNullable(mixed $input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('validate')
            ->with($input)
            ->willReturn(true);

        $rule = new Nullable($validatable);

        self::assertTrue($rule->validate($input));
    }

    #[Test]
    public function shouldNotAssertRuleWhenInputIsNull(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('assert');

        $rule = new Nullable($validatable);
        $rule->assert(null);
    }

    #[Test]
    #[DataProvider('providerForNotNullable')]
    public function shouldAssertRuleWhenInputIsNotNullable(mixed $input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('assert')
            ->with($input);

        $rule = new Nullable($validatable);
        $rule->assert($input);
    }

    #[Test]
    public function shouldNotCheckRuleWhenInputIsNull(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('check');

        $rule = new Nullable($validatable);
        $rule->check(null);
    }

    #[Test]
    #[DataProvider('providerForNotNullable')]
    public function shouldCheckRuleWhenInputIsNotNullable(mixed $input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('check')
            ->with($input);

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

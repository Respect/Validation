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
#[CoversClass(Optional::class)]
final class OptionalTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForOptional')]
    public function shouldNotValidateRuleWhenInputIsOptional(mixed $input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('validate');

        $rule = new Optional($validatable);

        self::assertTrue($rule->validate($input));
    }

    #[Test]
    #[DataProvider('providerForNotOptional')]
    public function shouldValidateRuleWhenInputIsNotOptional(mixed $input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('validate')
            ->with($input)
            ->willReturn(true);

        $rule = new Optional($validatable);

        self::assertTrue($rule->validate($input));
    }

    #[Test]
    public function shouldNotAssertRuleWhenInputIsOptional(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('assert');

        $rule = new Optional($validatable);

        $rule->assert('');
    }

    #[Test]
    public function shouldAssertRuleWhenInputIsNotOptional(): void
    {
        $input = 'foo';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('assert')
            ->with($input);

        $rule = new Optional($validatable);

        $rule->assert($input);
    }

    #[Test]
    public function shouldNotCheckRuleWhenInputIsOptional(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('check');

        $rule = new Optional($validatable);

        $rule->check('');
    }

    #[Test]
    public function shouldCheckRuleWhenInputIsNotOptional(): void
    {
        $input = 'foo';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('check')
            ->with($input);

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

<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(Nullable::class)]
final class NullableTest extends TestCase
{
    #[Test]
    public function shouldNotValidateRuleWhenInputIsNull(): void
    {
        $rule = new Nullable(Stub::pass(1));

        self::assertTrue($rule->validate(null));
    }

    #[Test]
    #[DataProvider('providerForNotNullable')]
    public function shouldValidateRuleWhenInputIsNotNullable(mixed $input): void
    {
        $rule = new Nullable(Stub::pass(1));

        self::assertTrue($rule->validate($input));
    }

    #[Test]
    #[DoesNotPerformAssertions]
    public function shouldNotAssertRuleWhenInputIsNull(): void
    {
        $sut = new Nullable(Stub::pass(0));
        $sut->assert(null);
    }

    #[Test]
    #[DataProvider('providerForNotNullable')]
    public function shouldAssertRuleWhenInputIsNotNullable(mixed $input): void
    {
        $rule = Stub::pass(1);

        $sut = new Nullable($rule);
        $sut->assert($input);

        self::assertSame([$input], $rule->inputs);
    }

    #[Test]
    #[DoesNotPerformAssertions]
    public function shouldNotCheckRuleWhenInputIsNull(): void
    {
        $rule = new Nullable(Stub::pass(0));
        $rule->check(null);
    }

    #[Test]
    #[DataProvider('providerForNotNullable')]
    public function shouldCheckRuleWhenInputIsNotNullable(mixed $input): void
    {
        $rule = Stub::pass(1);

        $sut = new Nullable($rule);
        $sut->check($input);

        self::assertSame([$input], $rule->inputs);
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

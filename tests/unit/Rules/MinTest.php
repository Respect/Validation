<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;

#[Group('rule')]
#[CoversClass(Min::class)]
final class MinTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonIterableTypes')]
    public function itShouldInvalidateNonIterableValues(mixed $input): void
    {
        $rule = new Min(Stub::daze());

        self::assertInvalidInput($rule, $input);
    }

    /** @param iterable<mixed> $input */
    #[Test]
    #[DataProvider('providerForEmptyIterableValues')]
    public function itShouldInvalidateEmptyIterableValues(iterable $input): void
    {
        $rule = new Min(Stub::daze());

        self::assertInvalidInput($rule, $input);
    }

    /** @param iterable<mixed> $input */
    #[Test]
    #[DataProvider('providerForNonEmptyIterableValues')]
    public function itShouldValidateNonEmptyIterableValuesWhenWrappedRulePasses(iterable $input): void
    {
        $rule = new Min(Stub::pass(1));

        self::assertValidInput($rule, $input);
    }

    /** @param iterable<mixed> $input */
    #[Test]
    #[DataProvider('providerForMinValues')]
    public function itShouldValidateWithTheMinimumValue(iterable $input, mixed $min): void
    {
        $wrapped = Stub::pass(1);

        $rule = new Min($wrapped);
        $rule->evaluate($input);

        self::assertSame($min, $wrapped->inputs[0]);
    }

    /** @return array<string, array{iterable<mixed>, mixed}> */
    public static function providerForMinValues(): array
    {
        $yesterday = new DateTimeImmutable('yesterday');
        $today = new DateTimeImmutable('today');
        $tomorrow = new DateTimeImmutable('tomorrow');

        return [
            '3 DateTime objects' => [[$yesterday, $today, $tomorrow], $yesterday],
            '2 DateTime objects' => [[$today, $tomorrow], $today],
            '1 DateTime objects' => [[$tomorrow], $tomorrow],
            '3 integers' => [[1, 2, 3], 1],
            '2 integers' => [[2, 3], 2],
            '1 integer' => [[3], 3],
            '1 integer with value `0`' => [[0], 0],
            '3 characters' => [['a', 'b', 'c'], 'a'],
            '2 characters' => [['b', 'c'], 'b'],
            '1 character' => [['c'], 'c'],
        ];
    }
}

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

#[Group('validator')]
#[CoversClass(Max::class)]
final class MaxTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonIterableTypes')]
    public function itShouldInvalidateNonIterableValues(mixed $input): void
    {
        $validator = new Max(Stub::daze());

        self::assertInvalidInput($validator, $input);
    }

    /** @param iterable<mixed> $input */
    #[Test]
    #[DataProvider('providerForEmptyIterableValues')]
    public function itShouldInvalidateEmptyIterableValues(iterable $input): void
    {
        $validator = new Max(Stub::daze());

        self::assertInvalidInput($validator, $input);
    }

    /** @param iterable<mixed> $input */
    #[Test]
    #[DataProvider('providerForNonEmptyIterableValues')]
    public function itShouldValidateNonEmptyIterableValuesWhenWrappedRulePasses(iterable $input): void
    {
        $validator = new Max(Stub::pass(1));

        self::assertValidInput($validator, $input);
    }

    /** @param iterable<mixed> $input */
    #[Test]
    #[DataProvider('providerForMaxValues')]
    public function itShouldValidateWithTheMaximumValue(iterable $input, mixed $min): void
    {
        $wrapped = Stub::pass(1);

        $validator = new Max($wrapped);
        $validator->evaluate($input);

        self::assertSame($min, $wrapped->inputs[0]);
    }

    /** @return array<string, array{iterable<mixed>, mixed}> */
    public static function providerForMaxValues(): array
    {
        $yesterday = new DateTimeImmutable('yesterday');
        $today = new DateTimeImmutable('today');
        $tomorrow = new DateTimeImmutable('tomorrow');

        return [
            '3 DateTime objects' => [[$yesterday, $today, $tomorrow], $tomorrow],
            '2 DateTime objects' => [[$yesterday, $today], $today],
            '1 DateTime objects' => [[$yesterday], $yesterday],
            '3 integers' => [[1, 2, 3], 3],
            '2 integers' => [[1, 2], 2],
            '1 integer' => [[1], 1],
            '3 characters' => [['a', 'b', 'c'], 'c'],
            '2 characters' => [['a', 'b'], 'b'],
            '1 character' => [['a'], 'a'],
        ];
    }
}

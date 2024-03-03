<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Rules\ConcreteFilteredNonEmptyArray;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(FilteredNonEmptyArray::class)]
final class NonEmptyArrayFilteredTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonIterableValues')]
    public function itShouldInvalidateNonIterableValues(mixed $input): void
    {
        $sut = new ConcreteFilteredNonEmptyArray(Stub::daze());

        self::assertInvalidInput($sut, $input);
    }

    /** @param iterable<mixed> $input */
    #[Test]
    #[DataProvider('providerForEmptyIterableValues')]
    public function itShouldInvalidateEmptyIterableValues(iterable $input): void
    {
        $sut = new ConcreteFilteredNonEmptyArray(Stub::daze());

        self::assertInvalidInput($sut, $input);
    }

    #[Test]
    public function itShouldEvaluateNonEmptyIterables(): void
    {
        $rule = Stub::pass(1);

        $input = [1, 2, 3];

        $sut = new ConcreteFilteredNonEmptyArray($rule);
        $sut->evaluate($input);

        self::assertSame([$input], $rule->inputs);
    }

    #[Test]
    public function itShouldKeepRuleIdWhenInvalidatingNonIterableValues(): void
    {
        $sut = new ConcreteFilteredNonEmptyArray(Stub::daze());
        $result = $sut->evaluate(null);

        self::assertEquals('concreteFilteredNonEmptyArray', $result->id);
    }

    #[Test]
    public function itShouldKeepRuleIdWhenInvalidatingEmptyIterableValues(): void
    {
        $sut = new ConcreteFilteredNonEmptyArray(Stub::daze());
        $result = $sut->evaluate([]);

        self::assertEquals('concreteFilteredNonEmptyArray', $result->id);
    }
}

<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Core\ConcreteFilteredNonEmptyArray;
use Respect\Validation\Test\Validators\Stub;

#[Group('core')]
#[CoversClass(FilteredNonEmptyArray::class)]
final class FilteredNonEmptyArrayTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonIterableTypes')]
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
        $validator = Stub::pass(1);

        $input = [1, 2, 3];

        $sut = new ConcreteFilteredNonEmptyArray($validator);
        $sut->evaluate($input);

        self::assertSame([$input], $validator->inputs);
    }

    #[Test]
    public function itShouldKeepRuleIdWhenInvalidatingNonIterableValues(): void
    {
        $sut = new ConcreteFilteredNonEmptyArray(Stub::daze());
        $result = $sut->evaluate(null);

        self::assertEquals('concreteFilteredNonEmptyArray', $result->id->value);
    }

    #[Test]
    public function itShouldKeepRuleIdWhenInvalidatingEmptyIterableValues(): void
    {
        $sut = new ConcreteFilteredNonEmptyArray(Stub::daze());
        $result = $sut->evaluate([]);

        self::assertEquals('concreteFilteredNonEmptyArray', $result->id->value);
    }
}

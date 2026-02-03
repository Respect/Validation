<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Core\ConcreteFilteredArray;
use Respect\Validation\Test\Validators\Stub;

#[Group('core')]
#[CoversClass(FilteredArray::class)]
final class FilteredArrayTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonIterableTypes')]
    public function itShouldInvalidateNonIterableValues(mixed $input): void
    {
        $sut = new ConcreteFilteredArray(Stub::daze());

        self::assertInvalidInput($sut, $input);
    }

    /** @param iterable<mixed> $input */
    #[Test]
    #[DataProvider('providerForEmptyIterableValues')]
    public function itShouldValidateEmptyIterableValuesAndNoteTheIndeterminate(iterable $input): void
    {
        $sut = new ConcreteFilteredArray(Stub::daze());

        $this->assertTrue($sut->evaluate($input)->isIndeterminate);
    }

    #[Test]
    public function itShouldEvaluateNonEmptyIterables(): void
    {
        $validator = Stub::pass(1);

        $input = [1, 2, 3];

        $sut = new ConcreteFilteredArray($validator);
        $sut->evaluate($input);

        self::assertSame([$input], $validator->inputs);
    }

    #[Test]
    public function itShouldKeepRuleIdWhenInvalidatingNonIterableValues(): void
    {
        $sut = new ConcreteFilteredArray(Stub::daze());
        $result = $sut->evaluate(null);

        self::assertEquals('concreteFilteredArray', $result->id->value);
    }

    #[Test]
    public function itShouldKeepRuleIdWhenValidatingEmptyIterableValues(): void
    {
        $sut = new ConcreteFilteredArray(Stub::daze());
        $result = $sut->evaluate([]);

        self::assertEquals('concreteFilteredArray', $result->id->value);
    }
}

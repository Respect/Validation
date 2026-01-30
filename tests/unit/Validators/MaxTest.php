<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;

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
    public function itShouldValidateEmptyIterableValuesAndNoteTheIndeterminate(iterable $input): void
    {
        $validator = new Max(Stub::daze());

        $this->assertTrue($validator->evaluate($input)->isIndeterminate);
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

<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Test\Stubs\CountableStub;
use Respect\Validation\Test\TestCase;

#[Group('validator')]
#[CoversClass(BetweenExclusive::class)]
final class BetweenExclusiveTest extends TestCase
{
    #[Test]
    public function minimumValueShouldNotBeGreaterThanMaximumValue(): void
    {
        $this->expectExceptionObject(
            new InvalidValidatorException('Minimum cannot be less than or equals to maximum'),
        );

        new BetweenExclusive(10, 5);
    }

    #[Test]
    public function minimumValueShouldNotBeEqualsToMaximumValue(): void
    {
        $this->expectExceptionObject(
            new InvalidValidatorException('Minimum cannot be less than or equals to maximum'),
        );

        new BetweenExclusive(5, 5);
    }

    #[Test]
    #[DataProvider('providerForValidInput')]
    public function shouldValidateValidInput(mixed $minValue, mixed $maxValue, mixed $input): void
    {
        self::assertValidInput(new BetweenExclusive($minValue, $maxValue), $input);
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function shouldValidateInvalidInput(mixed $minValue, mixed $maxValue, mixed $input): void
    {
        self::assertInvalidInput(new BetweenExclusive($minValue, $maxValue), $input);
    }

    /** @return array<array{mixed, mixed, mixed}> */
    public static function providerForValidInput(): array
    {
        return [
            'positive numbers' => [10, 20, 15],
            'negative numbers' => [-10, 20, -5],
            'positive and negative numbers' => [-10, 20, 0],
            'letters' => ['a', 'z', 'j'],
            'date time objects' => [new DateTime('yesterday'), new DateTime('tomorrow'), new DateTime('now')],
            'countable objects' => [new CountableStub(1), new CountableStub(10), 5],
            'countable objects against integer' => [new CountableStub(1), new CountableStub(10), 5],
        ];
    }

    /** @return array<array{mixed, mixed, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            'equals to the max value' => [10, 20, 20],
            'equals to the min value' => [10, 20, 10],
            'equals to the max value without a gap' => [0, 1, 1],
            'equals to the min value without a gap' => [0, 1, 0],
            'empty string' => [10, 20, ''],
            'greater than max value' => [0, 1, 2],
            'less than min value' => [0, 1, -1],
            'letters greater than max value' => ['a', 'j', 'z'],
            'datetime greater than max value' => [
                new DateTime('yesterday'),
                new DateTime('now'),
                new DateTime('tomorrow'),
            ],
        ];
    }
}

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
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Validatable;
use Respect\Validation\Validator;

use function array_map;
use function iterator_to_array;

#[Group('rule')]
#[CoversClass(DateTimeDiff::class)]
final class DateTimeDiffTest extends RuleTestCase
{
    #[Test]
    public function isShouldThrowAnExceptionWhenTypeIsNotValid(): void
    {
        $this->expectException(InvalidRuleConstructorException::class);
        $this->expectExceptionMessageMatches('/"invalid" is not a valid type of age \(Available: .+\)/');

        new DateTimeDiff(Stub::daze(), 'invalid');
    }

    #[Test]
    #[DataProvider('providerForSiblingSuitableRules')]
    public function isShouldAcceptRulesThatCanBeAddedAsNextSibling(Validatable $rule): void
    {
        $this->expectNotToPerformAssertions();

        new DateTimeDiff($rule);
    }

    #[Test]
    #[DataProvider('providerForSiblingUnsuitableRules')]
    public function isShouldNotAcceptRulesThatCanBeAddedAsNextSibling(Validatable $rule): void
    {
        $this->expectException(InvalidRuleConstructorException::class);
        $this->expectExceptionMessage('DateTimeDiff must contain exactly one rule');

        new DateTimeDiff($rule);
    }

    /** @return array<array{Validatable}> */
    public static function providerForSiblingSuitableRules(): array
    {
        return [
            'single' => [Stub::daze()],
            'single in validator' => [Validator::create(Stub::daze())],
            'single wrapped by "Not"' => [new Not(Stub::daze())],
            'validator wrapping not, wrapping single' => [Validator::create(new Not(Stub::daze()))],
            'not wrapping validator, wrapping single' => [new Not(Validator::create(Stub::daze()))],
        ];
    }

    /** @return array<array{Validatable}> */
    public static function providerForSiblingUnsuitableRules(): array
    {
        return [
            'double wrapped by validator' => [Validator::create(Stub::daze(), Stub::daze())],
            'double wrapped by validator, wrapped by "Not"' => [new Not(Validator::create(Stub::daze(), Stub::daze()))],
        ];
    }

    /** @return array<string|int, array{DateTimeDiff, mixed}> */
    public static function providerForValidInput(): array
    {
        return [
            'years' => [new DateTimeDiff(Stub::pass(1)), new DateTimeImmutable()],
            'months' => [new DateTimeDiff(Stub::pass(1), 'm'), new DateTimeImmutable()],
            'total number of full days' => [new DateTimeDiff(Stub::pass(1), 'days'), new DateTimeImmutable()],
            'number of days' => [new DateTimeDiff(Stub::pass(1), 'd'), new DateTimeImmutable()],
            'hours' => [new DateTimeDiff(Stub::pass(1), 'h'), new DateTimeImmutable()],
            'minutes' => [new DateTimeDiff(Stub::pass(1), 'i'), new DateTimeImmutable()],
            'seconds' => [new DateTimeDiff(Stub::pass(1), 's'), new DateTimeImmutable()],
            'microseconds' => [new DateTimeDiff(Stub::pass(1), 'f'), new DateTimeImmutable()],
        ];
    }

    /** @return array<string|int, array{DateTimeDiff, mixed}> */
    public static function providerForInvalidInput(): array
    {
        return [
            'valid date, with failing rule' => [
                new DateTimeDiff(Stub::fail(1), 'y'),
                new DateTimeImmutable(),
            ],
            'invalid date, with passing rule' => [
                new DateTimeDiff(Stub::pass(1), 'y', 'Y-m-d'),
                'invalid date',
            ],
            'invalid date, with failing rule' => [
                new DateTimeDiff(Stub::fail(1), 'y', 'Y-m-d'),
                new DateTimeImmutable(),
            ],
        ] + array_map(
            static fn (array $args): array => [new DateTimeDiff(Stub::fail(1)), new DateTimeImmutable()],
            iterator_to_array(self::providerForNonScalarValues())
        );
    }
}

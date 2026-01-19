<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Validators\Stub;

use function array_map;
use function iterator_to_array;

#[Group('validator')]
#[CoversClass(DateTimeDiff::class)]
final class DateTimeDiffTest extends RuleTestCase
{
    #[Test]
    public function isShouldThrowAnExceptionWhenTypeIsNotValid(): void
    {
        $this->expectException(InvalidValidatorException::class);
        $this->expectExceptionMessageMatches('/"invalid" is not a valid type of age \(Available: .+\)/');

        // @phpstan-ignore-next-line
        new DateTimeDiff('invalid', Stub::daze());
    }

    /** @return array<string|int, array{DateTimeDiff, mixed}> */
    public static function providerForValidInput(): array
    {
        return [
            'years + DateTime' => [new DateTimeDiff('years', Stub::pass(1)), new DateTimeImmutable()],
            'years + string' => [new DateTimeDiff('years', Stub::pass(1)), '2020-01-01'],
            'years + string + format' => [new DateTimeDiff('years', Stub::pass(1), 'Y-m-d'), '2020-01-01'],
            'years + string + format + now' => [
                new DateTimeDiff('years', Stub::pass(1), 'Y-m-d', new DateTimeImmutable()),
                '2020-01-01',
            ],
            'years + string + now' => [
                new DateTimeDiff('years', Stub::pass(1), null, new DateTimeImmutable()),
                '2020-01-01',
            ],
            'years + DateTime + now' => [
                new DateTimeDiff('years', Stub::pass(1), null, new DateTimeImmutable()),
                new DateTimeImmutable(),
            ],
            'months + DateTime' => [new DateTimeDiff('months', Stub::pass(1)), new DateTimeImmutable()],
            'days + DateTime' => [new DateTimeDiff('days', Stub::pass(1)), new DateTimeImmutable()],
            'hours + DateTime' => [new DateTimeDiff('hours', Stub::pass(1)), new DateTimeImmutable()],
            'minutes + DateTime' => [new DateTimeDiff('minutes', Stub::pass(1)), new DateTimeImmutable()],
            'seconds + DateTime' => [new DateTimeDiff('seconds', Stub::pass(1)), new DateTimeImmutable()],
            'microseconds + DateTime' => [new DateTimeDiff('microseconds', Stub::pass(1)), new DateTimeImmutable()],
        ];
    }

    /** @return array<string|int, array{DateTimeDiff, mixed}> */
    public static function providerForInvalidInput(): array
    {
        return [
            'valid date, with failing rule' => [
                new DateTimeDiff('years', Stub::fail(1)),
                new DateTimeImmutable(),
            ],
            'invalid date, with passing rule' => [
                new DateTimeDiff('years', Stub::pass(1), 'Y-m-d'),
                'invalid date',
            ],
            'invalid date, with failing rule' => [
                new DateTimeDiff('years', Stub::fail(1), 'Y-m-d'),
                'invalid date',
            ],
        ] + array_map(
            static fn(array $args): array => [new DateTimeDiff('years', Stub::fail(1)), new DateTimeImmutable()],
            iterator_to_array(self::providerForNonScalarValues()),
        );
    }
}

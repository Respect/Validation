<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use DateTimeImmutable;
use Lcobucci\Clock\FrozenClock;
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

    #[Test]
    public function itShouldCompareAgainstTheTimeGivenByTheClock(): void
    {
        $validator = Stub::pass(1);

        (new DateTimeDiff('years', $validator, null, null, self::clockAt('2024-01-01 12:00:00')))
            ->evaluate('2000-01-01');

        self::assertSame(24, $validator->inputs[0]);
    }

    #[Test]
    public function itShouldCompareRelativeInputAgainstTheSameInstantItIsResolvedWith(): void
    {
        $validator = Stub::pass(1);

        (new DateTimeDiff('years', $validator, null, null, self::clockAt('2024-01-01 12:00:00')))
            ->evaluate('7 years ago');

        self::assertSame(7, $validator->inputs[0]);
    }

    #[Test]
    public function itShouldTakeTheTimeTheFormatDoesNotAskForFromTheClock(): void
    {
        $validator = Stub::pass(1);

        (new DateTimeDiff('hours', $validator, 'Y-m-d', null, self::clockAt('2024-01-01 12:00:00')))
            ->evaluate('2024-01-01');

        self::assertSame(0, $validator->inputs[0]);
    }

    #[Test]
    public function itShouldPreferTheGivenNowOverTheClock(): void
    {
        $validator = Stub::pass(1);

        (new DateTimeDiff(
            'years',
            $validator,
            null,
            new DateTimeImmutable('2024-01-01 12:00:00'),
            self::clockAt('1999-01-01 12:00:00'),
        ))->evaluate('2000-01-01');

        self::assertSame(24, $validator->inputs[0]);
    }

    #[Test]
    public function itShouldKeepReportingTimeAsNowWhenOnlyTheClockIsGiven(): void
    {
        $result = (new DateTimeDiff('years', Stub::fail(1), null, null, self::clockAt('2024-01-01 12:00:00')))
            ->evaluate('2000-01-01');

        self::assertSame('now', $result->parameters['now']);
        self::assertSame(DateTimeDiff::TEMPLATE_STANDARD, $result->template);
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

    private static function clockAt(string $instant): FrozenClock
    {
        return new FrozenClock(new DateTimeImmutable($instant));
    }
}

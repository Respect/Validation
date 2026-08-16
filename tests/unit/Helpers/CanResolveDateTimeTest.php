<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use DateTimeImmutable;
use Lcobucci\Clock\FrozenClock;
use Lcobucci\Clock\SystemClock;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

use function abs;
use function date_default_timezone_get;
use function date_default_timezone_set;

#[Group('helper')]
final class CanResolveDateTimeTest extends TestCase
{
    use CanResolveDateTime;

    private const string INSTANT = '2024-01-31 22:45:12.654321';

    #[Test]
    #[DataProvider('providerForValueAndResolvedDateTime')]
    public function shouldResolveValueAgainstTheGivenInstant(string $value, string $expected): void
    {
        $resolved = $this->resolveDateTime($value, self::clockAt(self::INSTANT));

        self::assertNotNull($resolved);
        self::assertSame($expected, $resolved->format('Y-m-d H:i:s.u P'));
    }

    #[Test]
    #[DataProvider('providerForUnresolvableValue')]
    public function shouldNotResolveValueThatIsNotDateTime(mixed $value): void
    {
        self::assertNull($this->resolveDateTime($value, self::clockAt(self::INSTANT)));
    }

    #[Test]
    #[DataProvider('providerForValueParsableByPhp')]
    public function shouldResolveTheSameWayPhpDoesWhenGivenTheCurrentTime(string $value): void
    {
        $default = date_default_timezone_get();

        try {
            foreach (['UTC', 'Pacific/Kiritimati', 'Pacific/Midway', 'Asia/Tokyo', 'America/Sao_Paulo'] as $timezone) {
                date_default_timezone_set($timezone);

                $resolved = $this->resolveDateTime($value, SystemClock::fromSystemTimezone());
                $parsedByPhp = new DateTimeImmutable($value);

                self::assertNotNull($resolved);
                self::assertSame(
                    $parsedByPhp->format('P'),
                    $resolved->format('P'),
                    'Resolving "' . $value . '" in ' . $timezone . ' landed in another time zone than PHP does',
                );
                self::assertLessThan(
                    1.0,
                    abs((float) $parsedByPhp->format('U.u') - (float) $resolved->format('U.u')),
                    'Resolving "' . $value . '" in ' . $timezone . ' landed a second or more away from what PHP does',
                );
            }
        } finally {
            date_default_timezone_set($default);
        }
    }

    #[Test]
    #[DataProvider('providerForFormatAndResolvedDateTime')]
    public function shouldResolveFormattedValueTakingMissingFieldsFromTheGivenInstant(
        string $format,
        string $value,
        string $expected,
    ): void {
        $resolved = $this->resolveDateTimeFromFormat($format, $value, self::clockAt(self::INSTANT));

        self::assertNotNull($resolved);
        self::assertSame($expected, $resolved->format('Y-m-d H:i:s.u'));
    }

    #[Test]
    public function shouldNotResolveFormattedValueThatDoesNotMatchTheFormat(): void
    {
        $resolved = $this->resolveDateTimeFromFormat('Y-m-d', 'not a date', self::clockAt(self::INSTANT));

        self::assertNull($resolved);
    }

    /** @return array<string, array{string, string}> */
    public static function providerForValueAndResolvedDateTime(): array
    {
        return [
            'relative' => ['1 year ago', '2023-01-31 22:45:12.654321 +00:00'],
            'relative, on the boundary' => ['7 years ago', '2017-01-31 22:45:12.654321 +00:00'],
            'relative, off the boundary' => ['1 year ago + 1 minute', '2023-01-31 22:46:12.654321 +00:00'],
            'relative, sub-second' => ['-500 microseconds', '2024-01-31 22:45:12.653821 +00:00'],
            'relative, several units' => ['+1 week 2 days', '2024-02-09 22:45:12.654321 +00:00'],
            'now' => ['now', '2024-01-31 22:45:12.654321 +00:00'],
            'today' => ['today', '2024-01-31 00:00:00.000000 +00:00'],
            'yesterday' => ['yesterday', '2024-01-30 00:00:00.000000 +00:00'],
            'weekday' => ['next monday', '2024-02-05 00:00:00.000000 +00:00'],
            'month boundary' => ['first day of next month', '2024-02-01 22:45:12.654321 +00:00'],
            'time only' => ['10:00', '2024-01-31 10:00:00.000000 +00:00'],
            'time only, sub-second' => ['10:00:00.5', '2024-01-31 10:00:00.500000 +00:00'],
            'relative, with offset' => ['1 day ago +02:00', '2024-01-30 22:45:12.654321 +02:00'],
            'relative, with half-hour offset' => ['+90 minutes -03:30', '2024-02-01 00:15:12.654321 -03:30'],
            'relative, with abbreviation' => ['yesterday EST', '2024-01-30 00:00:00.000000 -05:00'],
            'relative, with timezone' => ['1 day ago UTC', '2024-01-30 22:45:12.654321 +00:00'],
            'time only, with offset' => ['10:00+02:00', '2024-01-31 10:00:00.000000 +02:00'],
            'time only, with timezone' => ['10:00 Europe/Lisbon', '2024-01-31 10:00:00.000000 +00:00'],
            'time only, with abbreviation' => ['10:00 EST', '2024-01-31 10:00:00.000000 -05:00'],
            'time without separator' => ['2024', '2024-01-31 20:24:00.000000 +00:00'],
            'month only' => ['may', '2024-05-31 00:00:00.000000 +00:00'],
            'empty' => ['', '2024-01-31 22:45:12.654321 +00:00'],
            'full date' => ['2020-01-01', '2020-01-01 00:00:00.000000 +00:00'],
            'full date and time' => ['1988-09-09 10:00:00.123456', '1988-09-09 10:00:00.123456 +00:00'],
            'full date, with offset' => ['2020-01-01T10:00:00+02:00', '2020-01-01 10:00:00.000000 +02:00'],
            'month and year' => ['December 2020', '2020-12-01 00:00:00.000000 +00:00'],
            'timestamp' => ['@1600000000', '2020-09-13 12:26:40.000000 +00:00'],
        ];
    }

    /** @return array<string, array{mixed}> */
    public static function providerForUnresolvableValue(): array
    {
        return [
            'not a date' => ['invalid date'],
            'unsupported wording' => ['5 days later'],
            'impossible date' => ['02-29'],
            'array' => [['2020-01-01']],
            'object' => [new DateTimeImmutable()],
            'null' => [null],
        ];
    }

    /** @return array<string, array{string}> */
    public static function providerForValueParsableByPhp(): array
    {
        $values = [];
        foreach (self::providerForValueAndResolvedDateTime() as $name => [$value]) {
            $values[$name] = [$value];
        }

        return $values;
    }

    /** @return array<string, array{string, string, string}> */
    public static function providerForFormatAndResolvedDateTime(): array
    {
        return [
            'date only, time from the instant' => ['d/m/Y', '09/12/1990', '1990-12-09 22:45:12.000000'],
            'year only, rest from the instant' => ['Y', '1990', '1990-01-31 22:45:12.000000'],
            'time only, date from the instant' => ['H:i', '10:00', '2024-01-31 10:00:00.000000'],
            'full date and time' => ['Y-m-d H:i:s', '1990-12-09 10:11:12', '1990-12-09 10:11:12.000000'],
            'sub-second in the value' => ['Y-m-d H:i:s.u', '1990-12-09 10:11:12.123456', '1990-12-09 10:11:12.123456'],
            'format resetting every field' => ['!d/m/Y', '09/12/1990', '1990-12-09 00:00:00.000000'],
            'timestamp format' => ['U', '1600000000', '2020-09-13 12:26:40.000000'],
        ];
    }

    private static function clockAt(string $instant): FrozenClock
    {
        return new FrozenClock(new DateTimeImmutable($instant));
    }
}

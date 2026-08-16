<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use DateTimeImmutable;
use DateTimeZone;
use Psr\Clock\ClockInterface;
use Throwable;

use function date_parse;
use function date_parse_from_format;
use function intdiv;
use function is_scalar;
use function preg_match;
use function round;
use function sprintf;
use function trim;

trait CanResolveDateTime
{
    private function resolveDateTime(mixed $value, ClockInterface $clock): DateTimeImmutable|null
    {
        if (!is_scalar($value)) {
            return null;
        }

        $value = (string) $value;
        if (trim($value) === '') {
            return $clock->now();
        }

        $parsed = date_parse($value);
        try {
            if ($parsed['year'] !== false && $parsed['month'] !== false && $parsed['day'] !== false) {
                return new DateTimeImmutable($value);
            }

            $instant = $clock->now();
            $zone = $this->timeZoneOf($parsed);
            $zoneType = $parsed['zone_type'] ?? false;

            if ($zone !== null && $zoneType === 3) {
                $instant = $instant->setTimezone($zone);
            } elseif ($zone !== null && isset($parsed['relative'])) {
                $instant = new DateTimeImmutable($instant->format('Y-m-d H:i:s.u'), $zone);
            } elseif ($zone !== null) {
                return new DateTimeImmutable($instant->format('Y-m-d') . ' ' . $value);
            }

            $resolved = $instant->modify($value);
            if ($parsed['hour'] === false) {
                if ($parsed['month'] === false && $parsed['day'] === false && $parsed['year'] === false) {
                    return $resolved;
                }

                return $resolved->setTime(0, 0);
            }

            $fraction = $parsed['fraction'] === false ? 0.0 : (float) $parsed['fraction'];

            return $resolved->setTime(
                (int) $resolved->format('G'),
                (int) $resolved->format('i'),
                (int) $resolved->format('s'),
                (int) round($fraction * 1000000),
            );
        } catch (Throwable) {
            return null;
        }
    }

    private function resolveDateTimeFromFormat(
        string $format,
        string $value,
        ClockInterface $clock,
    ): DateTimeImmutable|null {
        $resolved = DateTimeImmutable::createFromFormat($format, $value);
        if ($resolved === false) {
            return null;
        }

        if (preg_match('/(?<!\\\\)[!|U]/', $format) === 1) {
            return $resolved;
        }

        $instant = $clock->now()->setTimezone($resolved->getTimezone());
        $parsed = date_parse_from_format($format, $value);
        $resolved = $resolved->setDate(
            $parsed['year'] === false ? (int) $instant->format('Y') : $parsed['year'],
            $parsed['month'] === false ? (int) $instant->format('n') : $parsed['month'],
            $parsed['day'] === false ? (int) $instant->format('j') : $parsed['day'],
        );

        if (preg_match('/(?<!\\\\)[HGhgisuv]/', $format) === 1) {
            return $resolved;
        }

        return $resolved->setTime(
            (int) $instant->format('G'),
            (int) $instant->format('i'),
            (int) $instant->format('s'),
        );
    }

    /** @param array<string, mixed> $parsed */
    private function timeZoneOf(array $parsed): DateTimeZone|null
    {
        $zoneType = $parsed['zone_type'] ?? false;
        if ($zoneType === 1) {
            $offset = (int) $parsed['zone'];
            $minutes = intdiv($offset < 0 ? -$offset : $offset, 60);

            return new DateTimeZone(sprintf(
                '%s%02d:%02d',
                $offset < 0 ? '-' : '+',
                intdiv($minutes, 60),
                $minutes % 60,
            ));
        }

        if ($zoneType === 2 || $zoneType === 3) {
            return new DateTimeZone((string) ($parsed['tz_id'] ?? $parsed['tz_abbr']));
        }

        return null;
    }
}

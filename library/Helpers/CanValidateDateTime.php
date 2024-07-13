<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use DateInterval;
use DateTime;
use DateTimeZone;

use function checkdate;
use function date_default_timezone_get;
use function date_parse_from_format;
use function preg_match;
use function array_keys;
use function in_array;
use function get_object_vars;


trait CanValidateDateTime
{
    private function isDateTime(string $format, string $value): bool
    {
        $exceptionalFormats = $this->getExceptionalFormats();

        $format = $exceptionalFormats[$format] ?? $format;

        $info = date_parse_from_format($format, $value);

        if (!$this->isDateTimeParsable($info)) {
            return false;
        }

        if ($this->isDateFormat($format)) {
            $formattedDate = DateTime::createFromFormat(
                $format,
                $value,
                new DateTimeZone(date_default_timezone_get())
            );

            if ($formattedDate === false || $value !== $formattedDate->format($format)) {
                return false;
            }

            return $this->isDateInformation($info);
        }

        return true;
    }

    /**
     * @param mixed[] $info
     */
    private function isDateTimeParsable(array $info): bool
    {
        return $info['error_count'] === 0 && $info['warning_count'] === 0;
    }

    /**
     * Validates if the given string is a valid DateInterval type.
     * 
     * @param string $age
     * @return bool
     */
    private function isDateIntervalType(string $age): bool
    {
        return in_array($age, array_keys(get_object_vars((new DateInterval('P1Y')))));
    }

    private function isDateFormat(string $format): bool
    {
        return preg_match('/[djSFmMnYy]/', $format) > 0;
    }

    /**
     * @param mixed[] $info
     */
    private function isDateInformation(array $info): bool
    {
        if ($info['day']) {
            return checkdate((int) $info['month'], $info['day'], (int) $info['year']);
        }

        return checkdate($info['month'] ?: 1, 1, $info['year'] ?: 1);
    }

    /** @return array<string, string> */
    private function getExceptionalFormats(): array
    {
        return [
            'c' => 'Y-m-d\TH:i:sP',
            'r' => 'D, d M Y H:i:s O',
        ];
    }
}

<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanValidateDateTime;

use function date;
use function date_parse_from_format;
use function is_scalar;
use function strtotime;
use function vsprintf;

abstract class AbstractAge extends AbstractRule
{
    use CanValidateDateTime;

    private int $baseDate;

    abstract protected function compare(int $baseDate, int $givenDate): bool;

    public function __construct(private int $age, private ?string $format = null)
    {
        $this->baseDate = (int) date('Ymd') - $this->age * 10000;
    }

    public function validate(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        if ($this->format === null) {
            return $this->isValidWithoutFormat((string) $input);
        }

        return $this->isValidWithFormat($this->format, (string) $input);
    }

    private function isValidWithoutFormat(string $dateTime): bool
    {
        $timestamp = strtotime($dateTime);
        if ($timestamp === false) {
            return false;
        }

        return $this->compare($this->baseDate, (int) date('Ymd', $timestamp));
    }

    private function isValidWithFormat(string $format, string $dateTime): bool
    {
        if (!$this->isDateTime($format, $dateTime)) {
            return false;
        }

        return $this->compare(
            $this->baseDate,
            (int) vsprintf('%d%02d%02d', date_parse_from_format($format, $dateTime))
        );
    }
}

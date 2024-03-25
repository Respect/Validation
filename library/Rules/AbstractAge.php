<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanValidateDateTime;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

use function date;
use function date_parse_from_format;
use function is_scalar;
use function strtotime;
use function vsprintf;

abstract class AbstractAge extends Standard
{
    use CanValidateDateTime;

    private readonly int $baseDate;

    abstract protected function compare(int $baseDate, int $givenDate): bool;

    public function __construct(
        private readonly int $age,
        private readonly ?string $format = null
    ) {
        $this->baseDate = (int) date('Ymd') - $this->age * 10000;
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['age' => $this->age];
        if (!is_scalar($input)) {
            return Result::failed($input, $this, $parameters);
        }

        if ($this->format === null) {
            return new Result($this->isValidWithoutFormat((string) $input), $input, $this, $parameters);
        }

        return new Result($this->isValidWithFormat($this->format, (string) $input), $input, $this, $parameters);
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

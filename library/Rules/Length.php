<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Countable as CountableInterface;
use Respect\Validation\Exceptions\ComponentException;

use function count;
use function get_object_vars;
use function is_array;
use function is_int;
use function is_object;
use function is_string;
use function mb_strlen;
use function sprintf;

final class Length extends AbstractRule
{
    /**
     * @throws ComponentException
     */
    public function __construct(
        private readonly ?int $minValue = null,
        private readonly ?int $maxValue = null,
        private readonly bool $inclusive = true
    ) {

        if ($maxValue !== null && $minValue > $maxValue) {
            throw new ComponentException(sprintf('%d cannot be less than %d for validation', $minValue, $maxValue));
        }
    }

    public function validate(mixed $input): bool
    {
        $length = $this->extractLength($input);
        if ($length === null) {
            return false;
        }

        return $this->validateMin($length) && $this->validateMax($length);
    }

    private function extractLength(mixed $input): ?int
    {
        if (is_string($input)) {
            return (int) mb_strlen($input);
        }

        if (is_array($input) || $input instanceof CountableInterface) {
            return count($input);
        }

        if (is_object($input)) {
            return $this->extractLength(get_object_vars($input));
        }

        if (is_int($input)) {
            return $this->extractLength((string) $input);
        }

        return null;
    }

    private function validateMin(int $length): bool
    {
        if ($this->minValue === null) {
            return true;
        }

        if ($this->inclusive) {
            return $length >= $this->minValue;
        }

        return $length > $this->minValue;
    }

    private function validateMax(int $length): bool
    {
        if ($this->maxValue === null) {
            return true;
        }

        if ($this->inclusive) {
            return $length <= $this->maxValue;
        }

        return $length < $this->maxValue;
    }
}

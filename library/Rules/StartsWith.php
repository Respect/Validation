<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_array;
use function is_string;
use function mb_stripos;
use function mb_strpos;
use function reset;

final class StartsWith extends AbstractRule
{
    public function __construct(private mixed $startValue, private bool $identical = false)
    {
    }

    public function validate(mixed $input): bool
    {
        if ($this->identical) {
            return $this->validateIdentical($input);
        }

        return $this->validateEquals($input);
    }

    protected function validateEquals(mixed $input): bool
    {
        if (is_array($input)) {
            return reset($input) == $this->startValue;
        }

        if (is_string($input) && is_string($this->startValue)) {
            return mb_stripos($input, $this->startValue) === 0;
        }

        return false;
    }

    protected function validateIdentical(mixed $input): bool
    {
        if (is_array($input)) {
            return reset($input) === $this->startValue;
        }

        if (is_string($input) && is_string($this->startValue)) {
            return mb_strpos($input, $this->startValue) === 0;
        }

        return false;
    }
}

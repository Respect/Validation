<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function end;
use function is_array;
use function mb_strlen;
use function mb_strripos;
use function mb_strrpos;

final class EndsWith extends AbstractRule
{
    public function __construct(private mixed $endValue, private bool $identical = false)
    {
    }

    public function validate(mixed $input): bool
    {
        if ($this->identical) {
            return $this->validateIdentical($input);
        }

        return $this->validateEquals($input);
    }

    private function validateEquals(mixed $input): bool
    {
        if (is_array($input)) {
            return end($input) == $this->endValue;
        }

        return mb_strripos($input, $this->endValue) === mb_strlen($input) - mb_strlen($this->endValue);
    }

    private function validateIdentical(mixed $input): bool
    {
        if (is_array($input)) {
            return end($input) === $this->endValue;
        }

        return mb_strrpos($input, $this->endValue) === mb_strlen($input) - mb_strlen($this->endValue);
    }
}

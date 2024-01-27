<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_numeric;
use function is_string;
use function number_format;
use function preg_replace;
use function var_export;

final class Decimal extends AbstractRule
{
    public function __construct(private int $decimals)
    {
    }

    public function validate(mixed $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        return $this->toFormattedString($input) === $this->toRawString($input);
    }

    private function toRawString(mixed $input): string
    {
        if (is_string($input)) {
            return $input;
        }

        return var_export($input, true);
    }

    private function toFormattedString(mixed $input): string
    {
        $formatted = number_format((float) $input, $this->decimals, '.', '');
        if (is_string($input)) {
            return $formatted;
        }

        return preg_replace('/^(\d+\.\d)0*$/', '$1', $formatted) ?: '';
    }
}

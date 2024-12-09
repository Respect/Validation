<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_scalar;
use function mb_strlen;
use function preg_match;
use function preg_replace;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a valid PIS number',
    '{{name}} must not be a valid PIS number',
)]
final class Pis extends Simple
{
    protected function isValid(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $digits = (string) preg_replace('/\D/', '', (string) $input);
        if (mb_strlen($digits) != 11 || preg_match('/^' . $digits[0] . '{11}$/', $digits)) {
            return false;
        }

        $multipliers = [3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        $summation = 0;
        for ($position = 0; $position < 10; ++$position) {
            $summation += (int) $digits[$position] * $multipliers[$position];
        }

        $checkDigit = (int) $digits[10];

        $modulo = $summation % 11;

        return $checkDigit === ($modulo < 2 ? 0 : 11 - $modulo);
    }
}

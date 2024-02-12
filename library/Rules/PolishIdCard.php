<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function is_scalar;
use function ord;
use function preg_match;

/**
 * @see https://en.wikipedia.org/wiki/Polish_identity_card
 */
#[Template(
    '{{name}} must be a valid Polish Identity Card number',
    '{{name}} must not be a valid Polish Identity Card number',
)]
final class PolishIdCard extends Simple
{
    private const ASCII_CODE_0 = 48;
    private const ASCII_CODE_7 = 55;
    private const ASCII_CODE_9 = 57;
    private const ASCII_CODE_A = 65;

    public function validate(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $input = (string) $input;

        if (!preg_match('/^[A-Z0-9]{9}$/', $input)) {
            return false;
        }

        $weights = [7, 3, 1, 0, 7, 3, 1, 7, 3];
        $weightedSum = 0;
        for ($i = 0; $i < 9; ++$i) {
            $code = ord($input[$i]);
            if ($i < 3 && $code <= self::ASCII_CODE_9) {
                return false;
            }

            if ($i > 2 && $code >= self::ASCII_CODE_A) {
                return false;
            }

            $difference = $code <= self::ASCII_CODE_9 ? self::ASCII_CODE_0 : self::ASCII_CODE_7;
            $weightedSum += ($code - $difference) * $weights[$i];
        }

        return $weightedSum % 10 == $input[3];
    }
}

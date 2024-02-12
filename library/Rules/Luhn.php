<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function array_map;
use function count;
use function str_split;

/**
 * @see https://en.wikipedia.org/wiki/Luhn_algorithm
 */
#[Template(
    '{{name}} must be a valid Luhn number',
    '{{name}} must not be a valid Luhn number',
)]
final class Luhn extends Simple
{
    public function validate(mixed $input): bool
    {
        if (!(new Digit())->validate($input)) {
            return false;
        }

        return $this->isValid((string) $input);
    }

    private function isValid(string $input): bool
    {
        $sum = 0;
        $digits = array_map('intval', str_split($input));
        $numDigits = count($digits);
        $parity = $numDigits % 2;
        for ($i = 0; $i < $numDigits; ++$i) {
            $digit = $digits[$i];
            if ($parity == $i % 2) {
                $digit <<= 1;
                if (9 < $digit) {
                    $digit = $digit - 9;
                }
            }
            $sum += $digit;
        }

        return $sum % 10 == 0;
    }
}

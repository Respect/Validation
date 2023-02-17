<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function array_keys;
use function array_map;
use function array_pop;
use function array_sum;
use function intval;
use function is_numeric;
use function is_string;
use function str_split;
use function strlen;

/**
 * Validates Portugal's fiscal identification number (NIF)
 *
 *
 * @see https://pt.wikipedia.org/wiki/N%C3%BAmero_de_identifica%C3%A7%C3%A3o_fiscal
 *
 * @author Gonçalo Andrade <goncalo.andrade95@gmail.com>
 */
final class PortugueseNif extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        // Validate format and length
        if (!is_string($input)) {
            return false;
        }

        if (!is_numeric($input)) {
            return false;
        }

        if (strlen($input) != 9) {
            return false;
        }

        $digits = array_map(static fn (string $digit) => intval($digit), str_split($input));

        // Validate first and second digits
        switch ($digits[0]) {
            case 4:
                switch ($digits[1]) {
                    case 5:
                        break;
                    default:
                        return false;
                }
                break;
            case 7:
                switch ($digits[1]) {
                    case 0:
                    case 1:
                    case 2:
                    case 4:
                    case 5:
                    case 7:
                    case 8:
                    case 9:
                        break;
                    default:
                        return false;
                }
                break;
            case 9:
                switch ($digits[1]) {
                    case 0:
                    case 1:
                    case 8:
                    case 9:
                        break;
                    default:
                        return false;
                }
                break;
            default:
                break;
        }

        // Validate check digit
        $checkDigit = array_pop($digits);
        $digitKeys = array_keys($digits);
        $sumTerms = array_map(static fn (int $digit, int $position) => $digit * (9 - $position), $digits, $digitKeys);
        $sum = array_sum($sumTerms);
        $modulus = $sum % 11;

        if ($modulus == 0 || $modulus == 1) {
            return $checkDigit == 0;
        }

        return $checkDigit == 11 - $modulus;
    }
}

<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function array_map;
use function array_sum;
use function count;
use function is_scalar;
use function ord;
use function preg_replace;
use function str_split;
use function strtoupper;

/**
 * Validates if the input is a Brazilian National Registry of Legal Entities (CNPJ) number.
 *
 * Since 2026 the CNPJ can be alphanumeric: the first twelve positions may contain the letters
 * A to Z as well as digits, while the last two (the check digits) remain numeric. Each character
 * is converted to its verification value by subtracting 48 from its ASCII code, so '0'-'9' map to
 * 0-9 (identical to the previous numeric-only behaviour) and 'A'-'Z' map to 17-42.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jayson Reis <santosdosreis@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Renato Moura <renato@naturalweb.com.br>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class Cnpj extends AbstractRule
{
    /**
     * Value subtracted from a character's ASCII code to obtain its verification value.
     */
    private const BASE_ASCII = 48;

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        // Code ported from jsfromhell.com
        $bases = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $digits = $this->getDigits((string) $input);

        if (array_sum($digits) < 1) {
            return false;
        }

        if (count($digits) !== 14) {
            return false;
        }

        $n = 0;
        for ($i = 0; $i < 12; ++$i) {
            $n += $digits[$i] * $bases[$i + 1];
        }

        if ($digits[12] != (($n %= 11) < 2 ? 0 : 11 - $n)) {
            return false;
        }

        $n = 0;
        for ($i = 0; $i <= 12; ++$i) {
            $n += $digits[$i] * $bases[$i];
        }

        $check = ($n %= 11) < 2 ? 0 : 11 - $n;

        return $digits[13] == $check;
    }

    /**
     * @return int[]
     */
    private function getDigits(string $input): array
    {
        return array_map(
            static function (string $character): int {
                return ord($character) - self::BASE_ASCII;
            },
            str_split(
                (string) preg_replace('/[\W_]/', '', strtoupper($input))
            )
        );
    }
}

<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function array_map;
use function is_scalar;
use function preg_match;
use function str_split;

/**
 * Validates whether the input is a Polish VAT identification number (NIP).
 *
 * @see https://en.wikipedia.org/wiki/VAT_identification_number
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Tomasz Regdos <tomek@regdos.com>
 */
final class Nip extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        if (!preg_match('/^\d{10}$/', (string) $input)) {
            return false;
        }

        $weights = [6, 5, 7, 2, 3, 4, 5, 6, 7];
        $digits = array_map('intval', str_split((string) $input));

        $targetControlNumber = $digits[9];
        $calculateControlNumber = 0;

        for ($i = 0; $i < 9; ++$i) {
            $calculateControlNumber += $digits[$i] * $weights[$i];
        }

        $calculateControlNumber = $calculateControlNumber % 11;

        return $targetControlNumber == $calculateControlNumber;
    }
}

<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractRule;

/**
 * Validator for Polish VAT identification number (NIP).
 *
 * @see https://en.wikipedia.org/wiki/VAT_identification_number
 */
final class PlVatin extends AbstractRule
{
    public function validate($input)
    {
        if (!is_scalar($input)) {
            return false;
        }

        if (!preg_match('/^\d{10}$/', (string) $input)) {
            return false;
        }

        $weights = [6, 5, 7, 2, 3, 4, 5, 6, 7];

        $targetControlNumber = $input[9];
        $calculateControlNumber = 0;

        for ($i = 0; $i < 9; ++$i) {
            $calculateControlNumber += $input[$i] * $weights[$i];
        }

        $calculateControlNumber = $calculateControlNumber % 11;

        return $targetControlNumber == $calculateControlNumber;
    }
}

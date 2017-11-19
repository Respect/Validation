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
 * Validator for Polish identity card.
 *
 * @see https://en.wikipedia.org/wiki/Polish_identity_card
 */
class PlIdentityCard extends AbstractRule
{
    public function validate($input)
    {
        if (!preg_match('/^[A-Z0-9]{9}$/', $input)) {
            return false;
        }

        $weights = [7, 3, 1, 0, 7, 3, 1, 7, 3];
        $weightedSum = 0;
        for ($i = 0; $i < 9; ++$i) {
            $code = ord($input[$i]);
            if ($i < 3 && $code <= 57) { // 57 is "9"
                return false;
            }

            if ($i > 2 && $code >= 65) { // 65 is "A"
                return false;
            }

            $difference = $code <= 57 ? 48 : 55; // 48 is "0"
            $weightedSum += ($code - $difference) * $weights[$i];
        }

        return $weightedSum % 10 == $input[3];
    }
}

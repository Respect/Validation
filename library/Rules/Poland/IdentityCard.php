<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules\Poland;

use Respect\Validation\Rules\AbstractRule;

/**
 * Validator for Poland Identity Card.
 *
 * @link https://en.wikipedia.org/wiki/Polish_identity_card
 */
class IdentityCard extends AbstractRule
{
    public function validate($identityCard)
    {
        $values = array('0' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9,
            'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14, 'F' => 15, 'G' => 16, 'H' => 17, 'I' => 18, 'J' => 19,
            'K' => 20, 'L' => 21, 'M' => 22, 'N' => 23, 'O' => 24, 'P' => 25, 'Q' => 26, 'R' => 27, 'S' => 28, 'T' => 29,
            'U' => 30, 'V' => 31, 'W' => 32, 'X' => 33, 'Y' => 34, 'Z' => 35);

        $weights = [7, 3, 1, 0, 7, 3, 1, 7, 3];

        if (strlen($identityCard) != 9) {
            return false;
        }

        $calculateControlNumber = 0;

        for ($i = 0; $i < 9; $i++) {
            if ($i < 3 && $values[$identityCard[$i]] < 10) {
                return false;
            } elseif ($i > 2 && $values[$identityCard[$i]] > 9) {
                return false;
            }
            $calculateControlNumber += $values[$identityCard[$i]] * $weights[$i];
        }

        return $calculateControlNumber % 10 == $identityCard[3];
    }
}

<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

class Pesel extends AbstractRule
{
    public function validate($pesel)
    {
        $weights = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];

        if (!is_numeric($pesel) || strlen($pesel) != 11) {
            return false;
        }

        $targetControlNumber = $pesel[10];
        $calculateControlNumber = 0;

        for ($i = 0; $i < 10; $i++) {
            $calculateControlNumber += $pesel[$i] * $weights[$i];
        }

        $calculateControlNumber = (10 - $calculateControlNumber % 10) % 10;

        return $targetControlNumber == $calculateControlNumber;
    }
}

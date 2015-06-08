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

class PrimeNumber extends AbstractRule
{
    public function validate($input)
    {
        if (!is_numeric($input) || $input <= 1) {
            return false;
        }

        if ($input != 2 && ($input % 2) ==  0) {
            return false;
        }

        for ($i = 3; $i <= ceil(sqrt($input)); $i += 2) {
            if (($input % $i) == 0) {
                return false;
            }
        }

        return true;
    }
}

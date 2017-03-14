<?php

/*
 * This file is part of Respect/Validation.
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

class Pis extends AbstractRule
{
    public function validate($input)
    {
        $c = preg_replace('/\D/', '', $input);

        if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }

        $r = [3,2,9,8,7,6,5,4,3,2];

        for ($n = 0, $i = 0; $i <= 9; $n += $c[$i] * $r[$i++]);

        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }
}

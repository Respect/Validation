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

class Cnh extends AbstractRule
{
    public function validate($input)
    {
        // Canonicalize input
        $cnh = sprintf('%011s', preg_replace('{\D}', '', $cnh));

        // Validate length and invalid numbers
        if ((strlen($cnh) != 11) || (intval($cnh) == 0)) {
            return false;
        }

        // Validate check digits using a modulus 11 algorithm
        for ($c = $s1 = $s2 = 0, $p = 9; $c < 9; $c++, $p--) {
            $s1 += intval($cnh[$c]) * $p;
            $s2 += intval($cnh[$c]) * (10 - $p);
        }

        if ($cnh[9] != (($dv1 = $s1 % 11) > 9) ? 0 : $dv1) {
            return false;
        }

        if ($cnh[10] != (((($dv2 = ($s2 % 11) - (($dv1 > 9) ? 2 : 0)) < 0)
                ? $dv2 + 11 : $dv2) > 9) ? 0 : $dv2) {
            return false;
        }

        return true;
    }
}

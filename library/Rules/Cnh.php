<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_scalar;
use function mb_strlen;
use function preg_replace;

/**
 * Validates a Brazilian driver's license.
 *
 * @author Gabriel Pedro <gpedro@users.noreply.github.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Kinn Coelho Julião <kinncj@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class Cnh extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        // Canonicalize input
        $input = (string) preg_replace('{\D}', '', (string) $input);

        // Validate length and invalid numbers
        if (mb_strlen($input) != 11 || ((int) $input === 0)) {
            return false;
        }

        // Validate check digits using a modulus 11 algorithm
        for ($c = $s1 = $s2 = 0, $p = 9; $c < 9; $c++, $p--) {
            $s1 += (int) $input[$c] * $p;
            $s2 += (int) $input[$c] * (10 - $p);
        }

        $dv1 = $s1 % 11;
        if ($input[9] != ($dv1 > 9) ? 0 : $dv1) {
            return false;
        }

        $dv2 = $s2 % 11 - ($dv1 > 9 ? 2 : 0);
        $check = $dv2 < 0 ? $dv2 + 11 : ($dv2 > 9 ? 0 : $dv2);

        return $input[10] == $check;
    }
}

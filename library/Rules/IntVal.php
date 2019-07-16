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

class IntVal extends AbstractRule
{
    public function validate($input)
    {
        if (is_float($input) || is_bool($input)) {
            return false;
        }

        if (is_string($input) && strlen($input) > 0) {
            // allow leading zeros
            $input = ltrim($input, '0');

            if ($input === '') {
                // input contained only zeros
                return true;
            }
        }

        return false !== filter_var($input, FILTER_VALIDATE_INT);
    }
}

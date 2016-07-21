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

class Number extends AbstractRule
{
    public function validate($input)
    {
        if (!is_numeric($input)) {
            return false;
        }

        return !is_nan($input);
    }
}

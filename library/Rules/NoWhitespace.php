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

class NoWhitespace extends AbstractRule
{
    public function validate($input)
    {
        if (is_null($input)) {
            return true;
        }

        if (false === is_scalar($input)) {
            return false;
        }

        return !preg_match('#\s#', $input);
    }
}

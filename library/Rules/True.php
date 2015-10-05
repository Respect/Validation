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

class True extends AbstractRule
{
    public function validate($input)
    {
        if ($this->isOptional($input)) {
            return true;
        }

        return (true === filter_var($input, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE));
    }
}

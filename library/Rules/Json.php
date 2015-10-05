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

class Json extends AbstractRule
{
    public function validate($input)
    {
        if ($this->isOptional($input)) {
            return true;
        }

        if (is_string($input)
            && strtolower($input) == 'null') {
            return true;
        }

        return (null !== json_decode($input));
    }
}

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

use Respect\Validation\Exceptions\ComponentException;

class NanType extends AbstractRule
{
    public function validate($input)
    {
        if (is_numeric($input)) {
            return is_nan($input);
        }

        throw new ComponentException('The value must be a numeric.');
    }
}

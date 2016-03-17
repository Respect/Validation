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

class Iterable extends AbstractRule
{
    public function validate($input)
    {
        return is_array($input) ||
            $input instanceof \stdClass ||
            $input instanceof \Traversable;
    }
}

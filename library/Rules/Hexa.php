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

class Hexa extends AbstractRule
{
    public function __construct()
    {
        parent::__construct();
        trigger_error('Use xdigits instead.', E_USER_DEPRECATED);
    }

    public function validate($input)
    {
        return ctype_xdigit($input);
    }
}

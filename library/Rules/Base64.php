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

class Base64 extends AbstractRule
{
    public function validate($input)
    {
        return (boolean) preg_match('/^[a-zA-Z0-9\/\r\n+]+={0,2}$/', (string) $input);
    }
}

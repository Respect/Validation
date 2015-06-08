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

class Multiple extends AbstractRule
{
    public $multipleOf;

    public function __construct($multipleOf)
    {
        $this->multipleOf = $multipleOf;
    }

    public function validate($input)
    {
        if ($this->multipleOf == 0) {
            return ($input == 0);
        }

        return ($input % $this->multipleOf == 0);
    }
}

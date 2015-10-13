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

class Identical extends AbstractRule
{
    public $compareTo;

    public function __construct($compareTo)
    {
        $this->compareTo = $compareTo;
    }

    public function validate($input)
    {
        return $input === $this->compareTo;
    }
}

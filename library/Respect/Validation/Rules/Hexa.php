<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\HexaException;

class Hexa extends AbstractRule
{

    public function validate($input)
    {
        return ctype_xdigit($input);
    }

}
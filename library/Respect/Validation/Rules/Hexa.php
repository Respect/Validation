<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotHexadecimalException;

class Hexa extends AbstractRule
{

    public function validate($input)
    {
        return ctype_xdigit($input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new NotHexadecimalException($input);
        return true;
    }

}
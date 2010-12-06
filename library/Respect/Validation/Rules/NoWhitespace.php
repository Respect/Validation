<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NoWhitespaceException;

class NoWhitespace extends AbstractRule
{

    public function validate($input)
    {
        return preg_match('#^\S+$#', $input);
    }

}
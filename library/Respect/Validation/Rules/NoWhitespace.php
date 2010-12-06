<?php

namespace Respect\Validation\Rules;

class NoWhitespace extends AbstractRule
{

    public function validate($input)
    {
        return preg_match('#^\S+$#', $input);
    }

}
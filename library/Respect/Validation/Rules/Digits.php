<?php

namespace Respect\Validation\Rules;

class Digits extends AbstractRule
{

    public function validate($input)
    {
        return ctype_digit((string) $input);
    }

}
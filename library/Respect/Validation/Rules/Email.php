<?php

namespace Respect\Validation\Rules;

class Email extends AbstractRule
{

    public function validate($input)
    {
        return is_string($input) && filter_var($input, FILTER_VALIDATE_EMAIL);
    }

}
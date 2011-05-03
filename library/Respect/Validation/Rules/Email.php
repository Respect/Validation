<?php

namespace Respect\Validation\Rules;

class Email extends AbstractRule
{

    public function validate($input)
    {
       if (!is_string($input)) {
           return false;
       }

        return filter_var($input, FILTER_VALIDATE_EMAIL);
    }
}
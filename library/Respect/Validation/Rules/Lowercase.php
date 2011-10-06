<?php

namespace Respect\Validation\Rules;

class Lowercase extends AbstractRule
{

    public function validate($input)
    {
        return $input === strtolower($input);
    }

}
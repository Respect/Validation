<?php

namespace Respect\Validation\Rules;

class Uppercase extends AbstractRule
{

    public function validate($input)
    {
        return $input === strtoupper($input);
    }

}
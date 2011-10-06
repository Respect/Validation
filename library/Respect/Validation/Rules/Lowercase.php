<?php

namespace Respect\Validation\Rules;

class Lowercase extends AbstractRule
{

    public function validate($input)
    {
        if(function_exists('mb_strtolower'))
            return $input === mb_strtolower($input, mb_detect_encoding($input));
        
        return $input === strtolower($input);
    }

}
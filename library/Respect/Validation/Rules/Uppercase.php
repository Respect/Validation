<?php

namespace Respect\Validation\Rules;

class Uppercase extends AbstractRule
{

    public function validate($input)
    {
        if(function_exists('mb_strtoupper'))
            return $input === mb_strtoupper($input, mb_detect_encoding($input));
        
        return $input === strtoupper($input);
    }

}
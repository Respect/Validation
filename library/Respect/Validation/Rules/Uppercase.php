<?php

namespace Respect\Validation\Rules;

class Uppercase extends AbstractRule
{

    public function validate($input)
    {
        return $input === mb_strtoupper($input, mb_detect_encoding($input));
    }

}
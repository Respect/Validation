<?php

namespace Respect\Validation\Rules;

class Odd extends AbstractRule
{

    public function validate($input)
    {
        $input = (int) $input;
        return ($input % 2 !== 0);
    }

}

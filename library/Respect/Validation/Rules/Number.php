<?php

namespace Respect\Validation\Rules;

class Number extends AbstractRule
{

    public function validate($input)
    {
        return is_numeric($input);
    }

}


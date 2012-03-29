<?php

namespace Respect\Validation\Rules;

class Numeric extends AbstractRule
{

    public function validate($input)
    {
        return is_numeric($input);
    }

}

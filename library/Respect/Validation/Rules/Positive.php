<?php

namespace Respect\Validation\Rules;

class Positive extends AbstractRule
{

    public function validate($input)
    {
        return $input > 0;
    }

}

<?php

namespace Respect\Validation\Rules;

class NullValue extends AbstractRule
{

    public function validate($input)
    {
        return is_null($input);
    }

}

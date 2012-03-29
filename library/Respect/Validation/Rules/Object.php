<?php

namespace Respect\Validation\Rules;

class Object extends AbstractRule
{

    public function validate($input)
    {
        return is_object($input);
    }

}

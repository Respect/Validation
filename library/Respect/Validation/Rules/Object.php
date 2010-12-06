<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\ObjectException;

class Object extends AbstractRule
{

    public function validate($input)
    {
        return is_object($input);
    }

}
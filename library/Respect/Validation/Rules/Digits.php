<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\DigitsException;

class Digits extends AbstractRule
{

    public function validate($input)
    {
        return ctype_digit((string) $input);
    }

}
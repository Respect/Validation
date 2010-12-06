<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NumericException;

class Numeric extends AbstractRule
{

    public function validate($input)
    {
        return is_numeric($input);
    }

}
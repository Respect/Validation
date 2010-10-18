<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotNumericException;

class Numeric extends AbstractRule
{

    public function validate($input)
    {
        return is_numeric($input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new NotNumericException($input);
        return true;
    }

}
<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotDigitsException;

class Digits extends AbstractRule
{

    public function validate($input)
    {
        return ctype_digit((string) $input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new NotDigitsException($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}
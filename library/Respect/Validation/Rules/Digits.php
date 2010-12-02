<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\DigitsException;

class Digits extends AbstractRule
{

    public function createException()
    {
        return new DigitsException;
    }

    public function validate($input)
    {
        return ctype_digit((string) $input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this
                ->getException()
                ->setParams($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}
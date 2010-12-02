<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NumericException;

class Numeric extends AbstractRule
{

    public function createException()
    {
        return new NumericException;
    }

    public function validate($input)
    {
        return is_numeric($input);
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
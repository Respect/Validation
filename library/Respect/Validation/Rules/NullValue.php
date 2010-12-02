<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NullValueException;

class NullValue extends AbstractRule
{

    public function createException()
    {
        return new NullValueException;
    }

    public function validate($input)
    {
        return is_null($input);
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
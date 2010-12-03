<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\FloatException;

class Float extends AbstractRule
{
    public function createException()
    {
        return new FloatException;
    }


    public function validate($input)
    {
        return filter_var($input, FILTER_VALIDATE_FLOAT);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this
                ->getException()
                ->configure($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}
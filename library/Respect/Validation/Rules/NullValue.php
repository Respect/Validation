<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NullValueException;

class NullValue extends AbstractRule
{

    public function validate($input)
    {
        return is_null($input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->getException() ? : NullValueException::create()
                    ->configure($input);
        return true;
    }

}
<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\ArrException;
use \ArrayObject;

class Arr extends AbstractRule
{

    public function validate($input)
    {
        return is_array($input) || $input instanceof ArrayObject;
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->getException() ? : ArrException::create()
                    ->configure($input);
        return true;
    }

}
<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\HexaException;

class Hexa extends AbstractRule
{

    public function createException()
    {
        return new HexaException;
    }

    public function validate($input)
    {
        return ctype_xdigit($input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->getException() ? :  HexaException::create()
                ->configure($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}
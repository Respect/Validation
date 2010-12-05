<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\AlnumException;
use Respect\Validation\Exceptions\ComponentException;

class Alnum extends Alpha
{

    protected $additionalChars = '';
    protected $stringFormat = '#^[a-zA-Z0-9]+$#';

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->getException() ? : AlnumException::create()
                    ->configure($input, $this->additionalChars);
        return true;
    }

}
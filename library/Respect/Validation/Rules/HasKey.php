<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\HasKeyException;
use Respect\Validation\Exceptions\ValidationException;
use \ReflectionProperty;

class HasKey extends AbstractRelated
{
    const IS_OPTIONAL = false;

    protected function hasReference($input)
    {
        return array_key_exists($this->reference, $input);
    }

    protected function getReferenceValue($input)
    {
        return @$input[$this->reference];
    }

    protected function createException()
    {
        return HasKeyException::create();
    }

}
<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\KeyException;
use Respect\Validation\Exceptions\ValidationException;
use \ReflectionProperty;

class Key extends AbstractRelated
{

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
        return KeyException::create();
    }

}
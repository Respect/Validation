<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\HasKey;
use Respect\Validation\Exceptions\HasOptionalKeyException;

class HasOptionalKey extends HasKey
{

    public function validate($input)
    {
        return!array_key_exists($this->key, $input)
        || parent::validate($input[$this->key]);
    }

    public function createException()
    {
        return new HasOptionalKeyException;
    }

}
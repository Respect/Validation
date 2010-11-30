<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\HasKey;

class HasOptionalKey extends HasKey
{

    public function validate($input)
    {
        return!array_key_exists($this->key, $input)
        || parent::validate($input[$this->key]);
    }

}
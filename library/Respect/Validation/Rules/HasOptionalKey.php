<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\HasOptionalKeyException;

class HasOptionalKey extends HasKey
{
    const IS_OPTIONAL = true;

    protected function createException()
    {
        return HasOptionalKeyException::create();
    }

}
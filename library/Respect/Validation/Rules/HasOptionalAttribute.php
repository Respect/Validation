<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\HasOptionalAttributeException;

class HasOptionalAttribute extends HasAttribute
{
    const IS_OPTIONAL = true;

    protected function createException()
    {
        return HasOptionalAttributeException::create();
    }

}
<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\EachException;

class Each extends AbstractVector
{

    protected function createException()
    {
        return EachException::create();
    }

}
<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\ArrException;

class Arr extends Traversable
{

    protected function isTraversable($input)
    {
        return is_array($input);
    }

    protected function buildException($input)
    {
        return new ArrException($input);
    }

}
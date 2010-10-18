<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;

abstract class AbstractRule implements Validatable
{

    public function __invoke($input)
    {
        return $this->validate($input);
    }

}
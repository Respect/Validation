<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

abstract class AbstractRegexRule extends AbstractFilterRule
{

    abstract protected function getPregFormat();


    public function validateClean($input)
    {
        return preg_match($this->getPregFormat(), $input);
    }

}

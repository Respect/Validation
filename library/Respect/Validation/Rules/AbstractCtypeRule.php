<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

abstract class AbstractCtypeRule extends AbstractFilterRule
{
    abstract protected function ctypeFunction($input);

    protected function filter($input) {
        if (empty($this->additionalChars))
            return preg_replace('/\s/', '', $input);
        return parent::filter($input);
    }

    public function validateClean($input)
    {
        return $this->ctypeFunction($input);
    }
}

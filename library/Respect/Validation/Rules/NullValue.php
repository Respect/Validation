<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotNullException;

class NullValue extends AbstractRule
{

    public function validate($input)
    {
        return is_null($input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new NotNullException($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}
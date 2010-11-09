<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotObjectException;

class Object extends AbstractRule
{

    public function validate($input)
    {
        return is_object($input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new NotObjectException($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}
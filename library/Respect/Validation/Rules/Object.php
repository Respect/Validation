<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\ObjectException;

class Object extends AbstractRule
{
    public function createException()
    {
        return new ObjectException;
    }

    public function validate($input)
    {
        return is_object($input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this
                ->getException()
                ->setParams($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}
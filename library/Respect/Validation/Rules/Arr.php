<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotArrayException;

class Arr extends AbstractRule
{

    public function validate($input)
    {
        return is_array($input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new NotArrayException($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}
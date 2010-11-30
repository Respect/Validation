<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NoWhitespaceException;

class NoWhitespace extends AbstractRule
{

    public function validate($input)
    {
        return preg_match('#^\S+$#', $input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new NoWhitespaceException($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}
<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\TraversableException;
use \Traversable as Tvsable;

class Traversable extends AbstractRule
{

    public function validate($input)
    {
        return is_array($input) || $input instanceof Tvsable;
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new TraversableException($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}
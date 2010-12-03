<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\NotEmptyException;
use Respect\Validation\Rules\AbstractRule;

class NotEmpty extends AbstractRule
{

    public function createException()
    {
        return new NotEmptyException;
    }

    public function validate($input)
    {
        if (is_string($input))
            $input = trim($input);
        return!empty($input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this
                ->getException()
                ->configure($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}
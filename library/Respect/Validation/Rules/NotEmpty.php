<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\NotEmptyException;
use Respect\Validation\Rules\AbstractRule;

class NotEmpty extends AbstractRule
{

    public function validate($input)
    {
        if (is_string($input))
            $input = trim($input);
        return!empty($input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new NotEmptyException();
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}
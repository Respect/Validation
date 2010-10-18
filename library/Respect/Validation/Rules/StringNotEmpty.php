<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\EmptyStringException;
use Respect\Validation\Rules\AbstractRule;

class StringNotEmpty extends AbstractRule
{

    public function validate($input)
    {
        $trimmed = trim($input);
        return!empty($trimmed);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new EmptyStringException();
        return true;
    }

}
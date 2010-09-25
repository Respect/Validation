<?php

namespace Respect\Validation\String;

use Respect\Validation\Validatable;
use Respect\Validation\AbstractRule;

class NotEmpty extends AbstractRule implements Validatable
{

    public function validate($input)
    {
        $trimmed = trim($input);
        return!empty($trimmed);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new Exception();
    }

}
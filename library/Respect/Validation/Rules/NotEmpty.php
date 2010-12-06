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

}
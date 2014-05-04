<?php
namespace Respect\Validation\Rules;

class NotEmpty extends AbstractRule
{
    public function validate($input)
    {
        if (is_string($input)) {
            return trim($input) !== '';
        }

        return !empty($input);
    }
}


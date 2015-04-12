<?php
namespace Respect\Validation\Rules;

use \Respect\Validation\RequiredValidatable;

class NotEmpty extends AbstractRule implements RequiredValidatable
{
    public function validate($input)
    {
        if (is_string($input)) {
            $input = trim($input);
        }

        return !empty($input);
    }
}

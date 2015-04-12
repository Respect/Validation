<?php

namespace Respect\Validation\Rules;

use \Respect\Validation\RequiredValidatable;

class NotOptional extends AbstractRule implements RequiredValidatable
{
    public function validate($input) {

        return $input !== '';
    }

}

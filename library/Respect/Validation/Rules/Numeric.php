<?php

namespace Respect\Validation\Rules;

class Numeric extends AbstractRule
{

    public function validate($input)
    {
        return (string)$input === preg_replace('/[^0-9]/','',(string)$input);
    }

}

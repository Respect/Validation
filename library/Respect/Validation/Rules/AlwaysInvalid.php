<?php
namespace Respect\Validation\Rules;

class AlwaysInvalid extends AbstractRule
{
    public function validate($input)
    {
        return false;
    }
}


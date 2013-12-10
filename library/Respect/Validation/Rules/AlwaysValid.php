<?php
namespace Respect\Validation\Rules;

class AlwaysValid extends AbstractRule
{
    public function validate($input)
    {
        return true;
    }
}


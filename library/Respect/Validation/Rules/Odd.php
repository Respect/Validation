<?php
namespace Respect\Validation\Rules;

class Odd extends AbstractRule
{
    public function validate($input)
    {
        return ((int) $input % 2 !== 0);
    }
}


<?php
namespace Respect\Validation\Rules;

class Even extends AbstractRule
{
    public function validate($input)
    {
        return ( (int) $input % 2 === 0);
    }
}


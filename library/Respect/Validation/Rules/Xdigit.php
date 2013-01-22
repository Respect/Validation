<?php
namespace Respect\Validation\Rules;

class Xdigit extends AbstractRule
{
    public function validate($input)
    {
        return ctype_xdigit($input);
    }
}


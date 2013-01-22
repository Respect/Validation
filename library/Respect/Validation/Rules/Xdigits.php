<?php
namespace Respect\Validation\Rules;

class Xdigits extends AbstractRule
{
    public function validate($input)
    {
        return ctype_xdigit($input);
    }
}


<?php

namespace Respect\Validation\Rules;

class Hexa extends AbstractRule
{

    public function validate($input)
    {
        return ctype_xdigit($input);
    }

}

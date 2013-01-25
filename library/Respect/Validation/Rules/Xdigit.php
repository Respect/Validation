<?php
namespace Respect\Validation\Rules;

class Xdigit extends AbstractCtypeRule
{
    public function ctypeFunction($input)
    {
        return ctype_xdigit($input);
    }
}


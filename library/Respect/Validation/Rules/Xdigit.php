<?php
namespace Respect\Validation\Rules;

class Xdigit extends AbstractCtypeRule
{
    protected function filter($input)
    {
        return $input;
    }

    public function ctypeFunction($input)
    {
        return ctype_xdigit($input);
    }
}


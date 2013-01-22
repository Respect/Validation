<?php
namespace Respect\Validation\Rules;

class Print extends AbstractCtypeRule
{
    protected function filter($input)
    {
        return $input;
    }

    protected function ctypeFunction($input)
    {
        return ctype_print($input);
    }
}


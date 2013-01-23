<?php
namespace Respect\Validation\Rules;

class Prnt extends AbstractCtypeRule
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


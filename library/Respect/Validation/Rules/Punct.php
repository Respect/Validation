<?php
namespace Respect\Validation\Rules;

class Punct extends AbstractCtypeRule
{
    protected function filter($input)
    {
        return $input;
    }

    protected function ctypeFunction($input)
    {
        return ctype_punct($input);
    }
}


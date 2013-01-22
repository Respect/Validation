<?php
namespace Respect\Validation\Rules;

class Space extends AbstractCtypeRule
{
    protected function filter($input)
    {
        return $input;
    }

    protected function ctypeFunction($input)
    {
        return ctype_space($input);
    }
}


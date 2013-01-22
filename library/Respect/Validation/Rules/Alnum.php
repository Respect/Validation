<?php
namespace Respect\Validation\Rules;

class Alnum extends AbstractCtypeRule
{
    protected function ctypeFunction($input)
    {
        return ctype_alnum($input);
    }
}


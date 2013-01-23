<?php
namespace Respect\Validation\Rules;

class Punct extends AbstractCtypeRule
{
    protected function ctypeFunction($input)
    {
        return ctype_punct($input);
    }
}


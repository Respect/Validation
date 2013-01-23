<?php
namespace Respect\Validation\Rules;

class Space extends AbstractCtypeRule
{
    protected function ctypeFunction($input)
    {
        return ctype_space($input);
    }
}


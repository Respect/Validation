<?php
namespace Respect\Validation\Rules;

class Cntrl extends AbstractCtypeRule
{
    protected function ctypeFunction($input)
    {
        return ctype_cntrl($input);
    }
}


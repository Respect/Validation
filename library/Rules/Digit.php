<?php
namespace Respect\Validation\Rules;

class Digit extends AbstractCtypeRule
{
    protected function ctypeFunction($input)
    {
        return ctype_digit($input);
    }
}

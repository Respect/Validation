<?php
namespace Respect\Validation\Rules;

class Digit extends AbstractCtypeRule
{
    protected function filter($input)
    {
        return $this->filterWhiteSpaceOption($input);
    }

    protected function ctypeFunction($input)
    {
        return ctype_digit($input);
    }
}


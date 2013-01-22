<?php

namespace Respect\Validation\Rules;

class Digits extends AbstractCtypeRule
{
    public $additionalChars = "\n\r\t ";
    protected function ctypeFunction($input) {
        return ctype_digit($input);
    }
}

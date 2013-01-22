<?php

namespace Respect\Validation\Rules;

class Printable extends AbstractCtypeRule
{
    public $additionalChars = '';
    protected function ctypeFunction($input) {
        return ctype_print($input);
    }
}

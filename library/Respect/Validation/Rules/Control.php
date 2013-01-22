<?php

namespace Respect\Validation\Rules;

class Control extends AbstractCtypeRule
{
    public $additionalChars = '';
    protected function ctypeFunction($input) {
        return ctype_cntrl($input);
    }
}

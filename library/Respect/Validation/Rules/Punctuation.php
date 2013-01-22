<?php

namespace Respect\Validation\Rules;

class Punctuation extends AbstractCtypeRule
{
    public $additionalChars = '';
    protected function ctypeFunction($input) {
        return ctype_punct($input);
    }
}

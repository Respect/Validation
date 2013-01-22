<?php
namespace Respect\Validation\Rules;

class Space extends AbstractCtypeRule
{
    public $additionalChars = '';
    protected function ctypeFunction($input) {
        return ctype_space($input);
    }
}


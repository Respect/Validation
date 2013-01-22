<?php

namespace Respect\Validation\Rules;

class Graphical extends AbstractCtypeRule
{
    public $additionalChars = '';
    protected function ctypeFunction($input) {
        return ctype_graph($input);
    }
}

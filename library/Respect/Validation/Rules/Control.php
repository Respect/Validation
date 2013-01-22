<?php

namespace Respect\Validation\Rules;

class Control extends AbstractCtypeRule
{
    protected function filter($input) {
        return $input;
    }

    protected function ctypeFunction($input) {
        return ctype_cntrl($input);
    }
}

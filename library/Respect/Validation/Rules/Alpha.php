<?php
namespace Respect\Validation\Rules;

class Alpha extends AbstractCtypeRule
{
    protected function ctypeFunction($input) {
        return ctype_alpha($input);
    }
}


<?php
namespace Respect\Validation\Rules;

class Hexa extends AbstractRule
{
    public function __construct()
    {
        parent::__construct();
        trigger_error("Use xdigits instead.",
            E_USER_DEPRECATED);
    }

    public function validate($input)
    {
        return ctype_xdigit($input);
    }
}


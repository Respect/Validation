<?php
namespace Respect\Validation\Rules;

class Lowercase extends AbstractRule
{
    public function validate($input)
    {
        return $input === mb_strtolower($input, mb_detect_encoding($input));
    }
}


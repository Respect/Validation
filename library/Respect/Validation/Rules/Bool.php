<?php
namespace Respect\Validation\Rules;

class Bool extends AbstractRule
{
    public function validate($input)
    {
        return is_bool($input);
    }
}


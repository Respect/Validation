<?php
namespace Respect\Validation\Rules;

class PerfectSquare extends AbstractRule
{
    public function validate($input)
    {
        return is_numeric($input) && sqrt($input) * sqrt($input) == $input;
    }
}


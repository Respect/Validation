<?php
namespace Respect\Validation\Rules;

class NoWhitespace extends AbstractRule
{
    public function validate($input)
    {
        if (is_null($input)) {
            return true;
        }

        if (false === is_scalar($input)) {
            return false;
        }

        return !preg_match('#\s#', $input);
    }
}

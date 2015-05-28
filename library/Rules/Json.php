<?php
namespace Respect\Validation\Rules;

class Json extends AbstractRule
{
    public function validate($input)
    {
        if (is_string($input)
            && strtolower($input) == 'null') {
            return true;
        }

        return (null !== json_decode($input));
    }
}

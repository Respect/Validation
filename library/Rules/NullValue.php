<?php
namespace Respect\Validation\Rules;

class NullValue extends NotEmpty
{
    public function validate($input)
    {
        return is_null($input);
    }
}


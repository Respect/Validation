<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Validator as v;

class RGBColor extends AbstractRule
{
    public function validate($input)
    {
        return v::not(v::object())->validate($input) && v::startsWith('#')->validate($input) && 
               v::xdigit()->validate(substr($input, 1)) && hexdec($input) < 16777216;
    }
}


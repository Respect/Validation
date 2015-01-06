<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Validator as v;

class HexRgbColor extends AbstractRule
{
    public function validate($input)
    {
        if(v::oneOf(v::object(), v::arr(), v::nullValue())->validate($input)){
            return false;
        }
        
        if(!v::startsWith('#')->validate($input)){
            $input = '#' . $input;
        }
        
        return v::xdigit()->validate(mb_substr($input, 1))
                        && hexdec(mb_substr($input, 1)) < 16777216;
    }
}


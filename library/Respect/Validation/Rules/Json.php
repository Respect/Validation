<?php

namespace Respect\Validation\Rules;

class Json extends AbstractRule
{

    public function validate($input) 
    {
        return (bool) (json_decode($input));
    }

}



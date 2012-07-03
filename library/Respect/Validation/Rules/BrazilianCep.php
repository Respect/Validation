<?php

namespace Respect\Validation\Rules;

class BrazilianCep extends AbstractRule 
{
    public function validate($input) 
    {
        // Code ported from jsfromhell.com
        
        $c = preg_replace('/\D/', '', $input);
        
        if (strlen($c) != 8) 
            return false;
     
        return true;
    }
}

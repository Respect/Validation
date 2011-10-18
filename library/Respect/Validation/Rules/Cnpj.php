<?php

namespace Respect\Validation\Rules;

class Cnpj extends AbstractRule 
{
    public function validate($input) 
    {
        $input = preg_replace('([^0-9])', '', $input);
	return false;
    }
}

<?php

namespace Respect\Validation\Rules;

class Cpf extends AbstractRule 
{

    public function validate($input) 
    {

        $input = preg_replace('([^0-9])', '', $input);

        if (strlen($input) != 11)
            return false;
        
        if ($this->isSequenceOfNumber($input))
            return false;
        
        if ($this->processNumber($input))
            return true;
        
        return false;
    }
    
    private function processNumber($input)
    {
        $verify = array('firstDigit' => 0, 'secondDigit' => 0);

        $multiple = 10;

        for ($i = 0; $i < 9; $i++)
            $verify['firstDigit'] += ($multiple-- * (int) $input[$i]);

        $verify['firstDigit'] = 11 - ($verify['firstDigit'] % 11);

        if ($verify['firstDigit'] >= 10)
            $verify['firstDigit'] = 0;

        $multiple = 11;

        for ($i = 0; $i < 9; $i++)
            $verify['secondDigit'] += ($multiple-- * (int) $input[$i]);

        $verify['secondDigit'] += (2 * $verify['firstDigit']);
        $verify['secondDigit'] = 11 - ($verify['secondDigit'] % 11);

        if ($verify['secondDigit'] >= 10)
            $verify['secondDigit'] = 0;

        $digits = substr($input, (strlen($input) - 2), 2);

        if (strcmp("{$verify['firstDigit']}{$verify['secondDigit']}", $digits) === 0)
            return true;

        return false;
    }
   
    private function isSequenceOfNumber($input) 
    {   
        for ($i = 0; $i <= 9; $i++)
            if (strcmp($input, str_pad('', strlen($input), $i)) === 0)
                return true;
        
        return false;
    }

}

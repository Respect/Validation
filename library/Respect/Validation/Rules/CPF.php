<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\Length;

class CPF extends AbstractRule {

    public $cpf;

    public function __construct($cpf=null) {
        $this->cpf = $cpf;
    }

    public function validate($input) {

        $input = $this->clean($input);

        if ($this->isSequenceOfNumber($input))
            return false;
        
        if ($this->hasInvalidLength($input))
            return false;
        
        if ($this->processNumber($input))
            return true;
        
        return false;
    }
    
    private function processNumber($input)
    {
        $verify = array('firstDigit' => 0,
                        'secondDigit' => 0,
        );

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
    
    private function hasInvalidLength($input)
    {
        $vl = new Length(11,11);
        return !$vl->assert($input);
    }

    private function isSequenceOfNumber($input=null) 
    {
        for ($i = 0; $i <= 9; $i++)
            if (strcmp($input, str_pad('', strlen($input), $i)) === 0)
                return true;
        
        return false;
    }

    private function clean($input=null) 
    {
        return preg_replace("/\.|-/", "", $input);
    }

}
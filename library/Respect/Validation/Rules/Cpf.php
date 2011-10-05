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
        return $this->processNumber($input);
    }

    protected function processNumber($input)
    {
        $multiple = 10;
        $firstDigit = $secondDigit = 0;

        for ($i = 0; $i < 9; $i++)
            $firstDigit += ($multiple-- * (int) $input[$i]);

        $firstDigit = 11 - ($firstDigit % 11);
        $firstDigit >= 10 && $firstDigit = 0;

        $multiple = 11;

        for ($i = 0; $i < 9; $i++)
            $secondDigit += ($multiple-- * (int) $input[$i]);

        $secondDigit += (2 * $firstDigit);
        $secondDigit = 11 - ($secondDigit % 11);

        $secondDigit >= 10 && $secondDigit = 0;
        $digits = substr($input, -2);

        return ("{$firstDigit}{$secondDigit}" === $digits);
    }

    protected function isSequenceOfNumber($input)
    {   
        for ($i = 0; $i <= 9; $i++)
            if ($input === str_repeat($i, 11))
                return true;
        return false;
    }

}

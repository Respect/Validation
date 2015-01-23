<?php
namespace Respect\Validation\Rules;

class PrimeNumber extends AbstractRule
{
    public function validate($input)
    {
        if (!is_numeric($input) || $input <= 1) {
            return false;
        }

        if ($input != 2 && ($input % 2) ==  0) {
            return false;
        }

        for ($i = 2; $i < $input; $i++) {
            if (($input % $i) == 0) {
                return false;
            }
        }

        return true;
    }
}

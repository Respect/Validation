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

        for ($i = 3; $i <= ceil(sqrt($input)); $i+=2) {
            if (($input % $i) == 0) {
                return false;
            }
        }

        return true;
    }
}

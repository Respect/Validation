<?php
namespace Respect\Validation\Rules;

class PrimeNumber extends AbstractRule
{
    public function validate($input)
    {
        if (is_numeric($input) && $input > 0) {
            // Number of times to iterate = (int) (square root of input)
            $loop_limit = (int) sqrt( (int) $input);
            for ($i=2; $i <= $loop_limit; $i++) {
                if (($input % $i) == 0) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }
}


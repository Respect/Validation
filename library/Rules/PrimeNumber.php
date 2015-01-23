<?php
namespace Respect\Validation\Rules;

class PrimeNumber extends AbstractRule
{
    function validate($input){

        if(!is_numeric($input) || $input <= 0)
            return false;

        if($input % 2 ==  0) return false;

        for($i=2; $i < $input - 1; $i++){
            if($input % $i == 0)
                return false;
        }

        return true;

    }
}

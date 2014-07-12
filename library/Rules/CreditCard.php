<?php
namespace Respect\Validation\Rules;

class CreditCard extends AbstractRule
{
    public function validate($input)
    {
        $input = preg_replace('([^0-9])', '', $input);
        if (!empty($input)) {
            return $this->verifyMod10($input);
        }

        return false;
    }

    private function verifyMod10($input)
    {
        $sum = 0;
        $input = strrev($input);
        for ($i = 0; $i < strlen($input); $i++) {
            $current = substr($input, $i, 1);
            if ($i % 2 == 1) {
                $current *= 2;
                if ($current > 9) {
                    $firstDigit = $current % 10;
                    $secondDigit = ($current - $firstDigit) / 10;
                    $current = $firstDigit + $secondDigit;
                }
            }
            $sum += $current;
        }

        return ($sum % 10 == 0);
    }
}


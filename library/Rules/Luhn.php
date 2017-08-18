<?php

namespace Respect\Validation\Rules;

class Luhn extends AbstractRule
{
    public function validate($input)
    {
        $input = preg_replace('([^0-9])', '', $input);

        if (empty($input)) {
            return false;
        }

        return $this->verifyMod10($input);
    }

    /**
     * Returns whether the input matches the Luhn algorithm or not.
     *
     * @param string $input
     *
     * @return bool
     */
    private function verifyMod10($input)
    {
        $sum = 0;
        $input = strrev($input);
        for ($i = 0, $inputLength = mb_strlen($input); $i < $inputLength; ++$i) {
            $current = mb_substr($input, $i, 1);
            if ($i % 2 === 1) {
                $current *= 2;
                if ($current > 9) {
                    $firstDigit = $current % 10;
                    $secondDigit = ($current - $firstDigit) / 10;
                    $current = $firstDigit + $secondDigit;
                }
            }
            $sum += $current;
        }

        return $sum % 10 === 0;
    }
}

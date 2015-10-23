<?php

namespace Respect\Validation\Rules;


class Imei extends AbstractRule
{
    const IMEI_SIZE = 15;

    public function __construct()
    {
        $this->name = 'imei';
    }

    /**
     * @see https://en.wikipedia.org/wiki/International_Mobile_Station_Equipment_Identity
     * 
     * @param string $input
     *
     * @return bool
     */
    public function validate($input)
    {
        if (!$input || strlen($input) != self::IMEI_SIZE) {
            return false;
        }

        $numbers = preg_replace('/\D/', '', $input);
        $numbers = str_split($numbers);
        $numbers = array_reverse($numbers);

        $verify = array_shift($numbers);

        array_walk($numbers, function (&$number, $position) {
            if (($position + 1) % 2 == 1) {
                $n = $number * 2;
                $number = intval($n > 9 ? ($n % 10) + ($n / 10) : $n);
            }
        });

        $sum = array_sum($numbers);
        return (ceil($sum / 10) * 10) - $sum == $verify;
    }
}

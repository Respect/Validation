<?php

    namespace Respect\Validation\Rules;

    class NFe extends AbstractRule
    {

        /**
         * (MICV 4.01 - NT2009.006 #85)
         * @param string $aK access key
         * @return boolean
         */
        public function validate($aK)
        {
            if (strlen($aK) !== 44)
                return false;
            
            $w = [];

            for ($i = 0, $z = 5, $m = 43; $i <= $m; $i++) {
                $z = ($i < $m) ? ($z - 1) == 1 ? 9 : ($z - 1)  : 0;
                $w [] = $z;
            }

            for ($i = 0, $s = 0, $k = 44; $i < $k; ++$i)
                $s += $aK{ $i } * $w[ $i ];

            $s -= (11 * floor($s / 11));
            $v = ($s == 0 || $s == 1) ? 0 : (11 - $s);

            return $v == $aK{ 43 };
        }

    }
    
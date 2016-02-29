<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

class CreditCardVisa extends CreditCard
{

    public function validate($input)
    {
        $input = preg_replace('([^0-9])', '', $input);
        
        if (empty($input)) {
            return false;
        }

        if (!$this->verifyMod10($input)) {
            return false;
        }

        return $this->verifyIfCardIsVisa($input);
    }

    private function verifyIfCardIsVisa($input)
    {
        $pattern = "/^([4]{1})([0-9]{12,15})$/";//Visa

        if (preg_match($pattern, $input)) {
            return true;
        }

        return false;
    }

}

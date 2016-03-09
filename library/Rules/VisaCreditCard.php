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

class VisaCreditCard extends CreditCard
{

    public function validate($input)
    {
        $input = preg_replace('([^0-9])', '', $input);
        
        return parent::verifyMod10($input) && $this->verifyIfCardIsVisa($input);
    }

    private function verifyIfCardIsVisa($input)
    {
        $pattern = "/^4[0-9]{12,15}$/";//Visa

        return (preg_match($pattern, $input) > 0);
    }

}

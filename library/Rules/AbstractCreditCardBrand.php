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

abstract class AbstractCreditCardBrand extends CreditCard
{
    protected $pattern;

    private function verifyIfCardIsBrand($input)
    {
        return (preg_match($this->pattern, $input) > 0);
    }

    public function validate($input)
    {
        $input = preg_replace('([^0-9])', '', $input);

        return parent::verifyMod10($input) && $this->verifyIfCardIsBrand($input);
    }

}

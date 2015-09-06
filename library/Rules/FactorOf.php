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

use Respect\Validation\Exceptions\FactorOfException;

class FactorOf extends AbstractRule
{
    public function __construct($dividend)
    {
        if (!is_numeric($dividend) || (int) $dividend != $dividend || $dividend == 0) {
            throw new FactorOfException('Dividend must be an integer greater than 0');
        }

        $this->dividend = $dividend;
    }

    public function validate($input)
    {
        // Factors must be integers that are not zero.
        if (!is_numeric($input) || (int) $input != $input || $input == 0) {
            return false;
        }

        $input = (int) abs($input);
        $dividend = (int) abs($this->dividend);

        // The composite divided by the input must be an integer if input is a
        // factor of the composite.
        return is_integer($dividend / $input);
    }
}

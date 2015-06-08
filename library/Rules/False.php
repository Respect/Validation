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

class False extends AbstractRule
{
    public function validate($input)
    {
        if (!is_string($input) || is_numeric($input)) {
            return ($input == false);
        }

        $validValues = array(
            'false',
            'no',
            'off',
        );
        $filteredInput = strtolower($input);

        return in_array($filteredInput, $validValues);
    }
}

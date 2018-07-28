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

class Min extends AbstractInterval
{
    public function validate($input)
    {
        $filteredInput = $this->filterInterval($input);
        $filteredInterval = $this->filterInterval($this->interval);

        if (!$this->isAbleToCompareValues($filteredInput, $filteredInterval)) {
            return false;
        }

        if ($this->inclusive) {
            return $filteredInput >= $filteredInterval;
        }

        return $filteredInput > $filteredInterval;
    }
}

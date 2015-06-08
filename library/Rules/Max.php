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

class Max extends AbstractInterval
{
    public function validate($input)
    {
        if ($this->inclusive) {
            return $this->filterInterval($input) <= $this->filterInterval($this->interval);
        }

        return $this->filterInterval($input) < $this->filterInterval($this->interval);
    }
}

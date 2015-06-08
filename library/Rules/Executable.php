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

class Executable extends AbstractRule
{
    public function validate($input)
    {
        if ($input instanceof \SplFileInfo) {
            return $input->isExecutable();
        }

        return (is_string($input) && is_executable($input));
    }
}

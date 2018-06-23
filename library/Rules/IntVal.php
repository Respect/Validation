<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

class IntVal extends AbstractRule
{
    public function validate($input): bool
    {
        if (is_float($input)) {
            return false;
        }

        return false !== filter_var($input, FILTER_VALIDATE_INT);
    }
}

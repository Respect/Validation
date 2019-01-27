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

use function filter_var;
use function is_float;

/**
 * Validates if the input is an integer.
 *
 * @author Adam Benson <adam.benson@bigcommerce.com>
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Andrei Drulchenko <andrdru@gmail.com>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class IntVal extends AbstractRule
{
    public function validate($input): bool
    {
        if (is_float($input) || is_bool($input)) {
            return false;
        }

        return false !== filter_var($input, FILTER_VALIDATE_INT, FILTER_FLAG_ALLOW_OCTAL);
    }
}

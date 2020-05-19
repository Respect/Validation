<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function filter_var;
use function is_bool;
use function is_float;
use function is_string;
use function ltrim;
use function strlen;
use const FILTER_VALIDATE_INT;

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
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (is_float($input) || is_bool($input)) {
            return false;
        }

        if (is_string($input) && strlen($input) > 0) {
            // allow leading zeros
            $input = ltrim($input, '0');

            if ($input === '') {
                // input contained only zeros
                return true;
            }
        }

        return filter_var($input, FILTER_VALIDATE_INT) !== false;
    }
}

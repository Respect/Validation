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

/**
 * Validates whether the input is an odd number or not.
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 */
final class Odd extends AbstractRule
{
    public function validate($input): bool
    {
        if (false === filter_var($input, FILTER_VALIDATE_INT)) {
            return false;
        }

        return 0 !== (int) $input % 2;
    }
}

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

use const FILTER_VALIDATE_INT;

/**
 * Validates whether the input is an even number or not.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class Even extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (filter_var($input, FILTER_VALIDATE_INT) === false) {
            return false;
        }

        return (int) $input % 2 === 0;
    }
}

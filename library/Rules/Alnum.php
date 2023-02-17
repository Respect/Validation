<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function ctype_alnum;

/**
 * Validates whether the input is alphanumeric or not.
 *
 * Alphanumeric is a combination of alphabetic (a-z and A-Z) and numeric (0-9)
 * characters.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
final class Alnum extends AbstractFilterRule
{
    /**
     * {@inheritDoc}
     */
    protected function validateFilteredInput(string $input): bool
    {
        return ctype_alnum($input);
    }
}

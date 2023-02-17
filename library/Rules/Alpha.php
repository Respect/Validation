<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function ctype_alpha;

/**
 * Validates whether the input contains only alphabetic characters.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
final class Alpha extends AbstractFilterRule
{
    /**
     * {@inheritDoc}
     */
    protected function validateFilteredInput(string $input): bool
    {
        return ctype_alpha($input);
    }
}

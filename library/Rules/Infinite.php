<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_infinite;
use function is_numeric;

/**
 * Validates if the input is an infinite number
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Infinite extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        return is_numeric($input) && is_infinite((float) $input);
    }
}

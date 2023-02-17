<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_int;

/**
 * Validates whether the type of the input is integer.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class IntType extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        return is_int($input);
    }
}

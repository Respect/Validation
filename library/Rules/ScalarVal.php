<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_scalar;

/**
 * Validates whether the input is a scalar value or not.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ScalarVal extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        return is_scalar($input);
    }
}

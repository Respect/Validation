<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;

use function is_scalar;

/**
 * Validates whether the input is a scalar value or not.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
#[Attribute]
final class ScalarVal extends AbstractRule
{
    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        return is_scalar($input);
    }
}

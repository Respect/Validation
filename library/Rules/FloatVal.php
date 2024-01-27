<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function filter_var;
use function is_float;

use const FILTER_VALIDATE_FLOAT;

final class FloatVal extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        return is_float(filter_var($input, FILTER_VALIDATE_FLOAT));
    }
}

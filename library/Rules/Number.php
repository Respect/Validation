<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_nan;
use function is_numeric;

final class Number extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        return !is_nan((float) $input);
    }
}

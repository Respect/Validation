<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_int;
use function is_string;
use function preg_match;

final class IntVal extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        if (is_int($input)) {
            return true;
        }

        if (!is_string($input)) {
            return false;
        }

        return preg_match('/^-?\d+$/', $input) === 1;
    }
}

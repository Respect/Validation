<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_string;
use function mb_strtoupper;

final class Uppercase extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return $input === mb_strtoupper($input);
    }
}

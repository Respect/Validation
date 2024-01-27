<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_scalar;
use function preg_match;

final class Regex extends AbstractRule
{
    public function __construct(
        private readonly string $regex
    ) {
    }

    public function validate(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        return preg_match($this->regex, (string) $input) > 0;
    }
}

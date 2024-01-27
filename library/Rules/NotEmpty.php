<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_string;
use function trim;

final class NotEmpty extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        if (is_string($input)) {
            $input = trim($input);
        }

        return !empty($input);
    }
}

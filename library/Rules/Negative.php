<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function is_numeric;

#[Template(
    '{{name}} must be negative',
    '{{name}} must not be negative',
)]
final class Negative extends Simple
{
    public function validate(mixed $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        return $input < 0;
    }
}

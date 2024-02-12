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
    '{{name}} must be positive',
    '{{name}} must not be positive',
)]
final class Positive extends Simple
{
    public function validate(mixed $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        return $input > 0;
    }
}

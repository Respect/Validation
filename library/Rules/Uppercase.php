<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function is_string;
use function mb_strtoupper;

#[Template(
    '{{name}} must be uppercase',
    '{{name}} must not be uppercase',
)]
final class Uppercase extends Simple
{
    public function validate(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return $input === mb_strtoupper($input);
    }
}

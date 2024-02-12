<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function is_int;
use function is_string;
use function preg_match;

#[Template(
    '{{name}} must be an integer number',
    '{{name}} must not be an integer number',
)]
final class IntVal extends Simple
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

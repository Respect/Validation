<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function filter_var;
use function is_numeric;

use const FILTER_VALIDATE_INT;

#[Template(
    '{{name}} must be an odd number',
    '{{name}} must be an even number',
)]
final class Odd extends Simple
{
    protected function isValid(mixed $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        if (!filter_var($input, FILTER_VALIDATE_INT)) {
            return false;
        }

        return (int) $input % 2 !== 0;
    }
}

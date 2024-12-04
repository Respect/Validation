<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_string;
use function mb_strtoupper;

#[Template(
    '{{name}} must contain only uppercase letters',
    '{{name}} must not contain only uppercase letters',
)]
final class Uppercase extends Simple
{
    protected function isValid(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return $input === mb_strtoupper($input);
    }
}

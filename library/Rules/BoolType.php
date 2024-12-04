<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_bool;

#[Template(
    '{{name}} must be a boolean',
    '{{name}} must not be a boolean',
)]
final class BoolType extends Simple
{
    protected function isValid(mixed $input): bool
    {
        return is_bool($input);
    }
}

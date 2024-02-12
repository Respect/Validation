<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function is_bool;

#[Template(
    '{{name}} must be of type boolean',
    '{{name}} must not be of type boolean',
)]
final class BoolType extends Simple
{
    public function validate(mixed $input): bool
    {
        return is_bool($input);
    }
}

<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

use function is_int;

#[Template(
    '{{name}} must be of type integer',
    '{{name}} must not be of type integer',
)]
final class IntType extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        return is_int($input);
    }
}

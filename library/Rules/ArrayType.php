<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

use function is_array;

#[Template(
    '{{name}} must be of type array',
    '{{name}} must not be of type array',
)]
final class ArrayType extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        return is_array($input);
    }
}

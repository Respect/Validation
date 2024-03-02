<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function is_iterable;

#[Template(
    '{{name}} must be of type iterable',
    '{{name}} must not of type iterable',
)]
final class IterableType extends Simple
{
    public function validate(mixed $input): bool
    {
        return is_iterable($input);
    }
}

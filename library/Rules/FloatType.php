<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_float;

#[Template(
    '{{name}} must be of type float',
    '{{name}} must not be of type float',
)]
final class FloatType extends Simple
{
    protected function isValid(mixed $input): bool
    {
        return is_float($input);
    }
}

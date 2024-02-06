<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function is_object;
use function is_scalar;
use function method_exists;

#[Template(
    '{{name}} must be a string',
    '{{name}} must not be string',
)]
final class StringVal extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        return is_scalar($input) || (is_object($input) && method_exists($input, '__toString'));
    }
}

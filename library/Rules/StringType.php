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

#[Template(
    '{{name}} must be a string',
    '{{name}} must not be a string',
)]
final class StringType extends Simple
{
    protected function isValid(mixed $input): bool
    {
        return is_string($input);
    }
}

<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_infinite;
use function is_numeric;

#[Template(
    '{{name}} must be an infinite number',
    '{{name}} must not be an infinite number',
)]
final class Infinite extends Simple
{
    public function validate(mixed $input): bool
    {
        return is_numeric($input) && is_infinite((float) $input);
    }
}

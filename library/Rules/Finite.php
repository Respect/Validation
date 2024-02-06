<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function is_finite;
use function is_numeric;

#[Template(
    '{{name}} must be a finite number',
    '{{name}} must not be a finite number',
)]
final class Finite extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        return is_numeric($input) && is_finite((float) $input);
    }
}

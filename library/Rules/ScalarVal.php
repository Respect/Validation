<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_scalar;

#[Template(
    '{{name}} must be a scalar value',
    '{{name}} must not be a scalar value',
)]
final class ScalarVal extends Simple
{
    public function validate(mixed $input): bool
    {
        return is_scalar($input);
    }
}

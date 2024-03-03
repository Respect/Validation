<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_numeric;

#[Template(
    '{{name}} must be numeric',
    '{{name}} must not be numeric',
)]
final class NumericVal extends Simple
{
    public function validate(mixed $input): bool
    {
        return is_numeric($input);
    }
}

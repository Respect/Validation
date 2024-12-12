<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_numeric;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a negative number',
    '{{name}} must not be a negative number',
)]
final class Negative extends Simple
{
    protected function isValid(mixed $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        return $input < 0;
    }
}

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

use function is_string;
use function mb_strtolower;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must contain only lowercase letters',
    '{{name}} must not contain only lowercase letters',
)]
final class Lowercase extends Simple
{
    protected function isValid(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return $input === mb_strtolower($input);
    }
}

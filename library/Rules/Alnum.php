<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function ctype_alnum;

#[Template(
    '{{name}} must contain only letters (a-z) and digits (0-9)',
    '{{name}} must not contain letters (a-z) or digits (0-9)',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must contain only letters (a-z), digits (0-9) and {{additionalChars}}',
    '{{name}} must not contain letters (a-z), digits (0-9) or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Alnum extends Filter
{
    protected function isValid(string $input): bool
    {
        return ctype_alnum($input);
    }
}

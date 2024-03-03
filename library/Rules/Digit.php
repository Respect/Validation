<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\FilteredString;

use function ctype_digit;

#[Template(
    '{{name}} must contain only digits (0-9)',
    '{{name}} must not contain digits (0-9)',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must contain only digits (0-9) and {{additionalChars}}',
    '{{name}} must not contain digits (0-9) and {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Digit extends FilteredString
{
    protected function isValid(string $input): bool
    {
        return ctype_digit($input);
    }
}

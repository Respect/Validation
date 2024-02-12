<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function ctype_xdigit;

#[Template(
    '{{name}} contain only hexadecimal digits',
    '{{name}} must not contain hexadecimal digits',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} contain only hexadecimal digits and {{additionalChars}}',
    '{{name}} must not contain hexadecimal digits or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Xdigit extends Filter
{
    protected function isValid(string $input): bool
    {
        return ctype_xdigit($input);
    }
}

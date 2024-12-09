<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\FilteredString;

use function ctype_xdigit;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must only contain hexadecimal digits',
    '{{name}} must not only contain hexadecimal digits',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must contain hexadecimal digits and {{additionalChars}}',
    '{{name}} must not contain hexadecimal digits or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Xdigit extends FilteredString
{
    protected function isValid(string $input): bool
    {
        return ctype_xdigit($input);
    }
}

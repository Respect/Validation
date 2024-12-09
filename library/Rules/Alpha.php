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

use function ctype_alpha;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must contain only letters (a-z)',
    '{{name}} must not contain letters (a-z)',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must contain only letters (a-z) and {{additionalChars}}',
    '{{name}} must not contain letters (a-z) or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Alpha extends FilteredString
{
    protected function isValid(string $input): bool
    {
        return ctype_alpha($input);
    }
}

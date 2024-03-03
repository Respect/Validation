<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\FilteredString;

use function ctype_punct;

#[Template(
    '{{name}} must contain only punctuation characters',
    '{{name}} must not contain punctuation characters',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must contain only punctuation characters and {{additionalChars}}',
    '{{name}} must not contain punctuation characters or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Punct extends FilteredString
{
    protected function isValid(string $input): bool
    {
        return ctype_punct($input);
    }
}

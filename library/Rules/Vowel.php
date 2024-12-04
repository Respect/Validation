<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\FilteredString;

use function preg_match;

#[Template(
    '{{name}} must consist of vowels only',
    '{{name}} must not consist of vowels only',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must consist of vowels and {{additionalChars}}',
    '{{name}} must not consist of vowels or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Vowel extends FilteredString
{
    protected function isValid(string $input): bool
    {
        return preg_match('/^[aeiouAEIOU]+$/', $input) > 0;
    }
}

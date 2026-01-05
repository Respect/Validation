<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\FilteredString;

use function preg_match;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must consist of vowels only',
    '{{subject}} must not consist of vowels only',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must consist of vowels and {{additionalChars}}',
    '{{subject}} must not consist of vowels or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Vowel extends FilteredString
{
    protected function isValid(string $input): bool
    {
        return preg_match('/^[aeiouAEIOU]+$/', $input) > 0;
    }
}

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

use function preg_match;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must only contain consonants',
    '{{subject}} must not contain consonants',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must only contain consonants and {{additionalChars}}',
    '{{subject}} must not contain consonants or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Consonant extends FilteredString
{
    protected function isValid(string $input): bool
    {
        return preg_match('/^(\s|[b-df-hj-np-tv-zB-DF-HJ-NP-TV-Z])*$/', $input) > 0;
    }
}

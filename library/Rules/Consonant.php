<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function preg_match;

#[Template(
    '{{name}} must contain only consonants',
    '{{name}} must not contain consonants',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must contain only consonants and {{additionalChars}}',
    '{{name}} must not contain consonants or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Consonant extends AbstractFilterRule
{
    protected function validateFilteredInput(string $input): bool
    {
        return preg_match('/^(\s|[b-df-hj-np-tv-zB-DF-HJ-NP-TV-Z])*$/', $input) > 0;
    }
}

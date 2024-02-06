<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function ctype_alpha;

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
final class Alpha extends AbstractFilterRule
{
    protected function validateFilteredInput(string $input): bool
    {
        return ctype_alpha($input);
    }
}

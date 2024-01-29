<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

use function ctype_space;

#[Template(
    '{{name}} must contain only space characters',
    '{{name}} must not contain space characters',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must contain only space characters and {{additionalChars}}',
    '{{name}} must not contain space characters or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Space extends AbstractFilterRule
{
    protected function validateFilteredInput(string $input): bool
    {
        return ctype_space($input);
    }
}

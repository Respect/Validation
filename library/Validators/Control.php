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

use function ctype_cntrl;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must only contain control characters',
    '{{subject}} must not contain control characters',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must only contain control characters and {{additionalChars}}',
    '{{subject}} must not contain control characters or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Control extends FilteredString
{
    protected function isValid(string $input): bool
    {
        return ctype_cntrl($input);
    }
}

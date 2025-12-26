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

use function ctype_graph;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must contain only graphical characters',
    '{{subject}} must not contain graphical characters',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must contain only graphical characters and {{additionalChars}}',
    '{{subject}} must not contain graphical characters or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Graph extends FilteredString
{
    protected function isValid(string $input): bool
    {
        return ctype_graph($input);
    }
}

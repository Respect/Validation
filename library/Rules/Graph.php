<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\FilteredString;

use function ctype_graph;

#[Template(
    '{{name}} must contain only graphical characters',
    '{{name}} must not contain graphical characters',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must contain only graphical characters and {{additionalChars}}',
    '{{name}} must not contain graphical characters or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Graph extends FilteredString
{
    protected function isValid(string $input): bool
    {
        return ctype_graph($input);
    }
}

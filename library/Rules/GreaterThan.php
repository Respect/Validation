<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

#[Template(
    '{{name}} must be greater than {{compareTo}}',
    '{{name}} must not be greater than {{compareTo}}',
)]
final class GreaterThan extends AbstractComparison
{
    protected function compare(mixed $left, mixed $right): bool
    {
        return $left > $right;
    }
}

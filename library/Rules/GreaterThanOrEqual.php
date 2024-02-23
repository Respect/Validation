<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

#[Template(
    '{{name}} must be greater than or equal to {{compareTo}}',
    '{{name}} must not be greater than or equal to {{compareTo}}',
)]
final class GreaterThanOrEqual extends Comparison
{
    protected function compare(mixed $left, mixed $right): bool
    {
        return $left >= $right;
    }
}

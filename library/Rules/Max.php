<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

#[Template(
    '{{name}} must be less than or equal to {{compareTo}}',
    '{{name}} must not be less than or equal to {{compareTo}}',
)]
final class Max extends AbstractComparison
{
    protected function compare(mixed $left, mixed $right): bool
    {
        return $left <= $right;
    }
}

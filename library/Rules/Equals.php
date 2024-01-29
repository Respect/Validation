<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

#[Template(
    '{{name}} must equal {{compareTo}}',
    '{{name}} must not equal {{compareTo}}',
)]
final class Equals extends AbstractComparison
{
    protected function compare(mixed $left, mixed $right): bool
    {
        return $left == $right;
    }
}

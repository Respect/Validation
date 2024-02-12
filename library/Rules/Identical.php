<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

#[Template(
    '{{name}} must be identical as {{compareTo}}',
    '{{name}} must not be identical as {{compareTo}}',
)]
final class Identical extends Comparison
{
    protected function compare(mixed $left, mixed $right): bool
    {
        return $left === $right;
    }
}

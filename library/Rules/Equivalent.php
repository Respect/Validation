<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Comparison;

use function is_scalar;
use function mb_strtoupper;

#[Template(
    '{{name}} must be equivalent to {{compareTo}}',
    '{{name}} must not be equivalent to {{compareTo}}',
)]
final class Equivalent extends Comparison
{
    protected function compare(mixed $left, mixed $right): bool
    {
        if (!is_scalar($left)) {
            return $left == $right;
        }

        return mb_strtoupper((string) $left) === mb_strtoupper((string) $right);
    }
}

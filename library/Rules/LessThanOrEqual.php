<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Comparison;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be less than or equal to {{compareTo}}',
    '{{name}} must be greater than {{compareTo}}',
)]
final class LessThanOrEqual extends Comparison
{
    protected function compare(mixed $left, mixed $right): bool
    {
        return $left <= $right;
    }
}

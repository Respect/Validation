<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Comparison;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be greater than or equal to {{compareTo}}',
    '{{subject}} must be less than {{compareTo}}',
)]
final class GreaterThanOrEqual extends Comparison
{
    protected function compare(mixed $left, mixed $right): bool
    {
        return $left >= $right;
    }
}

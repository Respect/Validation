<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

#[Template(
    '{{name}} must be {{age}} years or less',
    '{{name}} must not be {{age}} years or less',
)]
final class MaxAge extends AbstractAge
{
    protected function compare(int $baseDate, int $givenDate): bool
    {
        return $baseDate <= $givenDate;
    }
}

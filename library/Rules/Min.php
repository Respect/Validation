<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

final class Min extends AbstractComparison
{
    protected function compare(mixed $left, mixed $right): bool
    {
        return $left >= $right;
    }
}

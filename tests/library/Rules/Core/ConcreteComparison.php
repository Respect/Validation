<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Rules\Core;

use Respect\Validation\Rules\Core\Comparison;

final class ConcreteComparison extends Comparison
{
    protected function compare(mixed $left, mixed $right): bool
    {
        return true;
    }
}

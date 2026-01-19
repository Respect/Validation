<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Validators\Core;

use Respect\Validation\Validators\Core\Comparison;

final class ConcreteComparison extends Comparison
{
    protected function compare(mixed $left, mixed $right): bool
    {
        return true;
    }
}

<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use function in_array;

trait CanValidateUndefined
{
    private function isUndefined(mixed $value): bool
    {
        return in_array($value, [null, ''], true);
    }
}

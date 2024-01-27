<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_infinite;
use function is_numeric;

final class Infinite extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        return is_numeric($input) && is_infinite((float) $input);
    }
}

<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function floor;
use function is_numeric;
use function sqrt;

final class PerfectSquare extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        return is_numeric($input) && floor(sqrt((float) $input)) == sqrt((float) $input);
    }
}

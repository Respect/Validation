<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function floor;
use function is_numeric;
use function sqrt;

#[Template(
    '{{name}} must be a valid perfect square',
    '{{name}} must not be a valid perfect square',
)]
final class PerfectSquare extends Simple
{
    public function validate(mixed $input): bool
    {
        return is_numeric($input) && floor(sqrt((float) $input)) == sqrt((float) $input);
    }
}

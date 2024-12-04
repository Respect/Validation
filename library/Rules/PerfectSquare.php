<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function floor;
use function is_numeric;
use function sqrt;

#[Template(
    '{{name}} must be a perfect square number',
    '{{name}} must not be a perfect square number',
)]
final class PerfectSquare extends Simple
{
    protected function isValid(mixed $input): bool
    {
        return is_numeric($input) && floor(sqrt((float) $input)) == sqrt((float) $input);
    }
}

<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function ceil;
use function is_numeric;
use function sqrt;

#[Template(
    '{{name}} must be a valid prime number',
    '{{name}} must not be a valid prime number',
)]
final class PrimeNumber extends Simple
{
    protected function isValid(mixed $input): bool
    {
        if (!is_numeric($input) || $input <= 1) {
            return false;
        }

        if ($input != 2 && ($input % 2) == 0) {
            return false;
        }

        for ($i = 3; $i <= ceil(sqrt((float) $input)); $i += 2) {
            if ($input % $i == 0) {
                return false;
            }
        }

        return true;
    }
}

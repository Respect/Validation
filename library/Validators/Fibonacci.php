<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function is_numeric;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid Fibonacci number',
    '{{subject}} must not be a valid Fibonacci number',
)]
final class Fibonacci extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        $sequence = [0, 1];
        $position = 1;
        while ($input > $sequence[$position]) {
            ++$position;
            $sequence[$position] = $sequence[$position - 1] + $sequence[$position - 2];
        }

        return $sequence[$position] === (int) $input;
    }
}

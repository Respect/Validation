<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function is_scalar;
use function preg_match;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a valid PESEL',
    '{{name}} must not be a valid PESEL',
)]
final class Pesel extends Simple
{
    protected function isValid(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $stringInput = (string) $input;
        if (!preg_match('/^\d{11}$/', (string) $stringInput)) {
            return false;
        }

        $weights = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];

        $targetControlNumber = $stringInput[10];
        $calculateControlNumber = 0;

        for ($i = 0; $i < 10; ++$i) {
            $calculateControlNumber += (int) $stringInput[$i] * $weights[$i];
        }

        $calculateControlNumber = (10 - $calculateControlNumber % 10) % 10;

        return $targetControlNumber == $calculateControlNumber;
    }
}

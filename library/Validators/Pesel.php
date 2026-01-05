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

use function is_scalar;
use function preg_match;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid PESEL',
    '{{subject}} must not be a valid PESEL',
)]
final class Pesel extends Simple
{
    public function isValid(mixed $input): bool
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

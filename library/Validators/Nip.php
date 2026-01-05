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

use function array_map;
use function is_scalar;
use function preg_match;
use function str_split;

/** @see https://en.wikipedia.org/wiki/VAT_identification_number */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid Polish VAT identification number',
    '{{subject}} must not be a valid Polish VAT identification number',
)]
final class Nip extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        if (!preg_match('/^\d{10}$/', (string) $input)) {
            return false;
        }

        $weights = [6, 5, 7, 2, 3, 4, 5, 6, 7];
        $digits = array_map('intval', str_split((string) $input));

        $targetControlNumber = $digits[9];
        $calculateControlNumber = 0;

        for ($i = 0; $i < 9; ++$i) {
            $calculateControlNumber += $digits[$i] * $weights[$i];
        }

        $calculateControlNumber %= 11;

        return $targetControlNumber == $calculateControlNumber;
    }
}

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

use function ctype_digit;
use function intval;
use function is_scalar;
use function mb_strlen;
use function strval;

/**
 * @see https://nl.wikipedia.org/wiki/Burgerservicenummer
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a valid BSN',
    '{{name}} must not be a valid BSN',
)]
final class Bsn extends Simple
{
    protected function isValid(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $input = (string) $input;

        if (!ctype_digit($input)) {
            return false;
        }

        if (mb_strlen(strval($input)) !== 9) {
            return false;
        }

        $sum = -1 * intval($input[8]);
        for ($i = 9; $i > 1; --$i) {
            $sum += $i * intval($input[9 - $i]);
        }

        return $sum !== 0 && $sum % 11 === 0;
    }
}

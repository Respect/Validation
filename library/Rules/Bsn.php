<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function ctype_digit;
use function intval;
use function is_scalar;
use function mb_strlen;
use function strval;

/**
 * Validates a Dutch citizen service number (BSN).
 *
 * @see https://nl.wikipedia.org/wiki/Burgerservicenummer
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ronald Drenth <ronalddrenth@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class Bsn extends AbstractRule
{
    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
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

<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Ronald Drenth <ronalddrenth@gmail.com>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function ctype_digit;
use function intval;
use function is_scalar;
use function mb_strlen;
use function strval;

/** @see https://nl.wikipedia.org/wiki/Burgerservicenummer */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid BSN',
    '{{subject}} must not be a valid BSN',
)]
final class Bsn extends Simple
{
    public function isValid(mixed $input): bool
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

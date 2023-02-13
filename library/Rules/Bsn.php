<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function ctype_digit;
use function intval;
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
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!ctype_digit($input)) {
            return false;
        }

        if (mb_strlen(strval($input)) !== 9) {
            return false;
        }

        $sum = -1 * intval($input[8]); /** @phpstan-ignore-line */
        for ($i = 9; $i > 1; --$i) {
            $sum += $i * intval($input[9 - $i]); /** @phpstan-ignore-line */
        }

        return $sum !== 0 && $sum % 11 === 0;
    }
}

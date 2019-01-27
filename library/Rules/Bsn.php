<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function ctype_digit;
use function mb_strlen;

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
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (!ctype_digit($input)) {
            return false;
        }

        if (9 !== mb_strlen($input)) {
            return false;
        }

        $sum = -1 * $input[8];
        for ($i = 9; $i > 1; --$i) {
            $sum += $i * $input[9 - $i];
        }

        return 0 !== $sum && 0 === $sum % 11;
    }
}

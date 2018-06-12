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

use function is_scalar;
use function mb_strlen;
use function preg_replace;

/**
 * Validates if the input is a Brazilian National Registry of Legal Entities (CNPJ) number.
 *
 * @author Alexandre Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jayson Reis <jayson.reis@sabbre.com.br>
 * @author Renato Moura <renato@naturalweb.com.br>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class Cnpj extends AbstractRule
{
    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        // Code ported from jsfromhell.com
        $cleanInput = preg_replace('/\D/', '', $input);
        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        if ($cleanInput < 1) {
            return false;
        }

        if (14 != mb_strlen($cleanInput)) {
            return false;
        }

        for ($i = 0, $n = 0; $i < 12; $n += $cleanInput[$i] * $b[++$i]);

        if ($cleanInput[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($i = 0, $n = 0; $i <= 12; $n += $cleanInput[$i] * $b[$i++]);

        if ($cleanInput[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }
}

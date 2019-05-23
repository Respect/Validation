<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_scalar;
use function mb_strlen;
use function preg_match;
use function preg_replace;

/**
 * Validates a Brazilian PIS/NIS number.
 *
 * @author Bruno Koga <brunokoga187@gmail.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Pis extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $digits = preg_replace('/\D/', '', $input);
        if (mb_strlen($digits) != 11 || preg_match('/^'.$digits[0].'{11}$/', $digits)) {
            return false;
        }

        $multipliers = [3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        $summation = 0;
        for ($position = 0; $position < 10; ++$position) {
            $summation += (int) $digits[$position] * $multipliers[$position];
        }

        $checkDigit = (int) $digits[10];

        $modulo = $summation % 11;

        return $checkDigit === ($modulo < 2 ? 0 : 11 - $modulo);
    }
}

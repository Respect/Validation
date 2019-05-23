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

use function array_map;
use function count;
use function str_split;

/**
 * Validate whether a given input is a Luhn number.
 *
 * @see https://en.wikipedia.org/wiki/Luhn_algorithm
 *
 * @author Alexander Gorshkov <mazanax@yandex.ru>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Luhn extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!(new Digit())->validate($input)) {
            return false;
        }

        return $this->isValid((string) $input);
    }

    private function isValid(string $input): bool
    {
        $sum = 0;
        $digits = array_map('intval', str_split($input));
        $numDigits = count($digits);
        $parity = $numDigits % 2;
        for ($i = 0; $i < $numDigits; ++$i) {
            $digit = $digits[$i];
            if ($parity == ($i % 2)) {
                $digit <<= 1;
                if (9 < $digit) {
                    $digit = $digit - 9;
                }
            }
            $sum += $digit;
        }

        return ($sum % 10) == 0;
    }
}

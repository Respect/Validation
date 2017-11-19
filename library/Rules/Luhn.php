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

/**
 * @see https://en.wikipedia.org/wiki/Luhn_algorithm
 */
class Luhn extends AbstractRule
{
    /**
     * {@inheritdoc}
     */
    public function validate($input)
    {
        if (!(new Digit())->validate($input)) {
            return false;
        }

        return $this->isValid($input);
    }

    private function isValid($input): bool
    {
        $sum = 0;
        $numDigits = mb_strlen($input);
        $parity = $numDigits % 2;
        for ($i = 0; $i < $numDigits; ++$i) {
            $digit = mb_substr($input, $i, 1);
            if ($parity == ($i % 2)) {
                $digit <<= 1;
                if (9 < $digit) {
                    $digit = $digit - 9;
                }
            }
            $sum += $digit;
        }

        return 0 == ($sum % 10);
    }
}

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

use function mb_strlen;
use function mb_substr;

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
     * {@inheritdoc}
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

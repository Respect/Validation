<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Aleksandr Gorshkov <mazanax@yandex.ru>
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function array_map;
use function count;
use function str_split;

/** @see https://en.wikipedia.org/wiki/Luhn_algorithm */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid Luhn number',
    '{{subject}} must not be a valid Luhn number',
)]
final class Luhn extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!(new Digit())->evaluate($input)->hasPassed) {
            return false;
        }

        $sum = 0;
        $digits = array_map('intval', str_split((string) $input));
        $numDigits = count($digits);
        $parity = $numDigits % 2;
        for ($i = 0; $i < $numDigits; ++$i) {
            $digit = $digits[$i];
            if ($parity == $i % 2) {
                $digit <<= 1;
                if (9 < $digit) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
        }

        return $sum % 10 == 0;
    }
}

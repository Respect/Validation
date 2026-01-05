<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function array_map;
use function array_sum;
use function count;
use function is_scalar;
use function preg_replace;
use function str_split;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid CNPJ number',
    '{{subject}} must not be a valid CNPJ number',
)]
final class Cnpj extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        // Code ported from jsfromhell.com
        $bases = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $digits = $this->getDigits((string) $input);

        if (array_sum($digits) < 1) {
            return false;
        }

        if (count($digits) !== 14) {
            return false;
        }

        $n = 0;
        for ($i = 0; $i < 12; ++$i) {
            $n += $digits[$i] * $bases[$i + 1];
        }

        if ($digits[12] != (($n %= 11) < 2 ? 0 : 11 - $n)) {
            return false;
        }

        $n = 0;
        for ($i = 0; $i <= 12; ++$i) {
            $n += $digits[$i] * $bases[$i];
        }

        $check = ($n %= 11) < 2 ? 0 : 11 - $n;

        return $digits[13] == $check;
    }

    /** @return int[] */
    private function getDigits(string $input): array
    {
        return array_map(
            'intval',
            str_split(
                (string) preg_replace('/\D/', '', $input),
            ),
        );
    }
}

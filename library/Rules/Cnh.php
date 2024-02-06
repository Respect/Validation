<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function is_scalar;
use function mb_strlen;
use function preg_replace;

#[Template(
    '{{name}} must be a valid CNH number',
    '{{name}} must not be a valid CNH number',
)]
final class Cnh extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        // Canonicalize input
        $input = (string) preg_replace('{\D}', '', (string) $input);

        // Validate length and invalid numbers
        if (mb_strlen($input) != 11 || ((int) $input === 0)) {
            return false;
        }

        // Validate check digits using a modulus 11 algorithm
        for ($c = $s1 = $s2 = 0, $p = 9; $c < 9; $c++, $p--) {
            $s1 += (int) $input[$c] * $p;
            $s2 += (int) $input[$c] * (10 - $p);
        }

        $dv1 = $s1 % 11;
        if ($input[9] != ($dv1 > 9) ? 0 : $dv1) {
            return false;
        }

        $dv2 = $s2 % 11 - ($dv1 > 9 ? 2 : 0);
        $check = $dv2 < 0 ? $dv2 + 11 : ($dv2 > 9 ? 0 : $dv2);

        return $input[10] == $check;
    }
}

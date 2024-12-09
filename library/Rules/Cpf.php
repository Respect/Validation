<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function intval;
use function mb_strlen;
use function preg_match;
use function preg_replace;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a valid CPF number',
    '{{name}} must not be a valid CPF number',
)]
final class Cpf extends Simple
{
    protected function isValid(mixed $input): bool
    {
        // Code ported from jsfromhell.com
        $c = preg_replace('/\D/', '', $input);

        if (mb_strlen($c) != 11 || preg_match('/^' . $c[0] . '{11}$/', $c) || $c === '01234567890') {
            return false;
        }

        $n = 0;
        for ($s = 10, $i = 0; $s >= 2; ++$i, --$s) {
            $n += intval($c[$i]) * $s;
        }

        if ($c[9] != (($n %= 11) < 2 ? 0 : 11 - $n)) {
            return false;
        }

        $n = 0;
        for ($s = 11, $i = 0; $s >= 2; ++$i, --$s) {
            $n += intval($c[$i]) * $s;
        }

        $check = ($n %= 11) < 2 ? 0 : 11 - $n;

        return $c[10] == $check;
    }
}

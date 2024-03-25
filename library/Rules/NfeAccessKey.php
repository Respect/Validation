<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function array_map;
use function floor;
use function mb_strlen;
use function str_split;

/**
 * @see (pt-br) Manual de Integração do Contribuinte v4.0.1 em http://www.nfe.fazenda.gov.br
 */
#[Template(
    '{{name}} must be a valid NFe access key',
    '{{name}} must not be a valid NFe access key',
)]
final class NfeAccessKey extends Simple
{
    protected function isValid(mixed $input): bool
    {
        if (mb_strlen($input) !== 44) {
            return false;
        }

        $digits = array_map('intval', str_split($input));
        $w = [];
        for ($i = 0, $z = 5, $m = 43; $i <= $m; ++$i) {
            $z = $i < $m ? $z - 1 == 1 ? 9 : $z - 1 : 0;
            $w[] = $z;
        }

        for ($i = 0, $s = 0, $k = 44; $i < $k; ++$i) {
            $s += $digits[$i] * $w[$i];
        }

        $s -= 11 * floor($s / 11);
        $v = $s == 0 || $s == 1 ? 0 : 11 - $s;

        return $v == $digits[43];
    }
}

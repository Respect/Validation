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
use function floor;
use function mb_strlen;
use function str_split;

/**
 * Validates the access key of the Brazilian electronic invoice (NFe).
 *
 *
 * (pt-br) Valida chave de acesso de NFe, mais especificamente, relacionada ao DANFE.
 *
 * @see (pt-br) Manual de Integração do Contribuinte v4.0.1 em http://www.nfe.fazenda.gov.br
 *
 * @author Andrey Knupp Vital <andreykvital@gmail.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class NfeAccessKey extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (mb_strlen($input) !== 44) {
            return false;
        }

        $digits = array_map('intval', str_split($input));
        $w = [];
        for ($i = 0, $z = 5, $m = 43; $i <= $m; ++$i) {
            $z = $i < $m ? ($z - 1) == 1 ? 9 : ($z - 1) : 0;
            $w[] = $z;
        }

        for ($i = 0, $s = 0, $k = 44; $i < $k; ++$i) {
            $s += $digits[$i] * $w[$i];
        }

        $s -= 11 * floor($s / 11);
        $v = $s == 0 || $s == 1 ? 0 : (11 - $s);

        return $v == $digits[43];
    }
}

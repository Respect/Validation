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
 * Rule restrict to Brasil.
 *
 * Valida chave de acesso de NFe.
 * Mais especificamente, relacionada ao DANFE.
 */
class NfeAccessKey extends AbstractRule
{
    /**
     * @see Manual de Integração do Contribuinte v4.0.1 (http://www.nfe.fazenda.gov.br)
     *
     * @param string $aK access key
     *
     * @return bool
     */
    public function validate($aK)
    {
        if (44 !== mb_strlen($aK)) {
            return false;
        }

        $w = [];
        for ($i = 0, $z = 5, $m = 43; $i <= $m; ++$i) {
            $z = ($i < $m) ? 1 == ($z - 1) ? 9 : ($z - 1) : 0;
            $w[] = $z;
        }

        for ($i = 0, $s = 0, $k = 44; $i < $k; ++$i) {
            $s += $aK[$i]
            * $w[$i];
        }

        $s -= (11 * floor($s / 11));
        $v = (0 == $s || 1 == $s) ? 0 : (11 - $s);

        return $v == $aK[43];
    }
}

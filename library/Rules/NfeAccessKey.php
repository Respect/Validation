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
 * Validates the access key of the Brazilian electronic invoice (NFe).
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
final class NfeAccessKey extends AbstractRule
{
    /**
     * @see Manual de Integração do Contribuinte v4.0.1 (http://www.nfe.fazenda.gov.br)
     *
     * @param string $aK access key
     *
     * @return bool
     */
    public function validate($aK): bool
    {
        if (strlen($aK) !== 44) {
            return false;
        }

        $w = [];
        for ($i = 0, $z = 5, $m = 43; $i <= $m; ++$i) {
            $z = ($i < $m) ? ($z - 1) == 1 ? 9 : ($z - 1)  : 0;
            $w[] = $z;
        }

        for ($i = 0, $s = 0, $k = 44; $i < $k; ++$i) {
            $s += $aK{ $i }
            * $w[ $i ];
        }

        $s -= (11 * floor($s / 11));
        $v = ($s == 0 || $s == 1) ? 0 : (11 - $s);

        return $v == $aK{ 43 };
    }
}

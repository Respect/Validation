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

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validates whether an input is subdivision code of Central African Republic or not.
 *
 * ISO 3166-1 alpha-2: CF
 *
 * @see http://www.geonames.org/CF/administrative-division-central-african-republic.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class CfSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AC', // Ouham
           'BB', // Bamingui-Bangoran
           'BGF', // Bangui
           'BK', // Basse-Kotto
           'HK', // Haute-Kotto
           'HM', // Haut-Mbomou
           'HS', // Mambere-Kadeï
           'KB', // Nana-Grebizi
           'KG', // Kemo
           'LB', // Lobaye
           'MB', // Mbomou
           'MP', // Ombella-M'Poko
           'NM', // Nana-Mambere
           'OP', // Ouham-Pende
           'SE', // Sangha-Mbaere
           'UK', // Ouaka
           'VK', // Vakaga
       ];
    }
}

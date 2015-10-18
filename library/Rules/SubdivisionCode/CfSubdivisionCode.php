<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for Central African Republic subdivision code.
 *
 * ISO 3166-1 alpha-2: CF
 *
 * @link http://www.geonames.org/CF/administrative-division-central-african-republic.html
 */
class CfSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
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

    public $compareIdentical = true;
}

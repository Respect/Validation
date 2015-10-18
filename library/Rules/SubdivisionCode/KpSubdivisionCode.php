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
 * Validator for North Korea subdivision code.
 *
 * ISO 3166-1 alpha-2: KP
 *
 * @link http://www.geonames.org/KP/administrative-division-north-korea.html
 */
class KpSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // P'yongyang Special City
        '02', // P'yongan-namdo
        '03', // P'yongan-bukto
        '04', // Chagang-do
        '05', // Hwanghae-namdo
        '06', // Hwanghae-bukto
        '07', // Kangwon-do
        '08', // Hamgyong-namdo
        '09', // Hamgyong-bukto
        '10', // Ryanggang-do (Yanggang-do)
        '13', // Nasŏn (Najin-Sŏnbong)
    ];

    public $compareIdentical = true;
}

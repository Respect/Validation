<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * North Korea country subdivision.
 *
 * ISO 3166-1 alpha-2: KP
 *
 * @link http://www.geonames.org/KP/administrative-division-north-korea.html
 */
class KpCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
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
    );

    public $compareIdentical = true;
}

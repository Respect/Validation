<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Liberia country subdivision.
 *
 * ISO 3166-1 alpha-2: LR
 *
 * @link http://www.geonames.org/LR/administrative-division-liberia.html
 */
class LrCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BG', // Bong
        'BM', // Bomi
        'CM', // Grand Cape Mount
        'GB', // Grand Bassa
        'GG', // Grand Gedeh
        'GK', // Grand Kru
        'LO', // Lofa
        'MG', // Margibi
        'MO', // Montserrado
        'MY', // Maryland
        'NI', // Nimba
        'RI', // River Cess
        'SI', // Sinoe
    );

    public $compareIdentical = true;
}

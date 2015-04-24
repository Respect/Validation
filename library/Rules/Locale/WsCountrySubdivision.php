<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Samoa country subdivision.
 *
 * ISO 3166-1 alpha-2: WS
 *
 * @link http://www.geonames.org/WS/administrative-division-samoa.html
 */
class WsCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AA', // A'ana
        'AL', // Aiga-i-le-Tai
        'AT', // Atua
        'FA', // Fa'asaleleaga
        'GE', // Gaga'emauga
        'GI', // Gagaifomauga
        'PA', // Palauli
        'SA', // Satupa'itea
        'TU', // Tuamasaga
        'VF', // Va'a-o-Fonoti
        'VS', // Vaisigano
    );

    public $compareIdentical = true;
}

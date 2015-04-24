<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Honduras country subdivision.
 *
 * ISO 3166-1 alpha-2: HN
 *
 * @link http://www.geonames.org/HN/administrative-division-honduras.html
 */
class HnCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AT', // Atlantida
        'CH', // Choluteca
        'CL', // Colon
        'CM', // Comayagua
        'CP', // Copan
        'CR', // Cortes
        'EP', // El Paraiso
        'FM', // Francisco Morazan
        'GD', // Gracias a Dios
        'IB', // Islas de la Bahia (Bay Islands)
        'IN', // Intibuca
        'LE', // Lempira
        'LP', // La Paz
        'OC', // Ocotepeque
        'OL', // Olancho
        'SB', // Santa Barbara
        'VA', // Valle
        'YO', // Yoro
    );

    public $compareIdentical = true;
}

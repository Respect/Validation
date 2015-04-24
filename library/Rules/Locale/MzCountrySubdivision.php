<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Mozambique country subdivision.
 *
 * ISO 3166-1 alpha-2: MZ
 *
 * @link http://www.geonames.org/MZ/administrative-division-mozambique.html
 */
class MzCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'A', // Niassa
        'B', // Manica
        'G', // Gaza
        'I', // Inhambane
        'L', // Maputo
        'MPM', // Maputo (city)
        'N', // Nampula
        'P', // Cabo Delgado
        'Q', // Zambezia
        'S', // Sofala
        'T', // Tete
    );

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Andorra country subdivision.
 *
 * ISO 3166-1 alpha-2: AD
 *
 * @link http://www.geonames.org/AD/administrative-division-andorra.html
 */
class AdCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '02', // Canillo
        '03', // Encamp
        '04', // La Massana
        '05', // Ordino
        '06', // Sant Julia de Lòria
        '07', // Andorra la Vella
        '08', // Escaldes-Engordany
    );

    public $compareIdentical = true;
}

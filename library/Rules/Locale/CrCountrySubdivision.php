<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Costa Rica country subdivision.
 *
 * ISO 3166-1 alpha-2: CR
 *
 * @link http://www.geonames.org/CR/administrative-division-costa-rica.html
 */
class CrCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'A', // Alajuela
        'C', // Cartago
        'G', // Guanacaste
        'H', // Heredia
        'L', // Limon
        'P', // Puntarenas
        'SJ', // San Jose
    );

    public $compareIdentical = true;
}

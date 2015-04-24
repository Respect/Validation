<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Turkmenistan country subdivision.
 *
 * ISO 3166-1 alpha-2: TM
 *
 * @link http://www.geonames.org/TM/administrative-division-turkmenistan.html
 */
class TmCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'A', // Ahal Welayaty
        'B', // Balkan Welayaty
        'D', // Dashhowuz Welayaty
        'L', // Lebap Welayaty
        'M', // Mary Welayaty
        'S', // Aşgabat
    );

    public $compareIdentical = true;
}

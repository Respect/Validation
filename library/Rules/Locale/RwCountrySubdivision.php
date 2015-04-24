<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Rwanda country subdivision.
 *
 * ISO 3166-1 alpha-2: RW
 *
 * @link http://www.geonames.org/RW/administrative-division-rwanda.html
 */
class RwCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Kigali
        '02', // Est
        '03', // Nord
        '04', // Ouest
        '05', // Sud
    );

    public $compareIdentical = true;
}

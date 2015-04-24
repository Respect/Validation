<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Djibouti country subdivision.
 *
 * ISO 3166-1 alpha-2: DJ
 *
 * @link http://www.geonames.org/DJ/administrative-division-djibouti.html
 */
class DjCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AR', // Arta
        'AS', // 'Ali Sabih
        'DI', // Dikhil
        'DJ', // Djibouti
        'OB', // Obock
        'TA', // Tadjoura
    );

    public $compareIdentical = true;
}

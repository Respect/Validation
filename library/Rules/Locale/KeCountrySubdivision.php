<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Kenya country subdivision.
 *
 * ISO 3166-1 alpha-2: KE
 *
 * @link http://www.geonames.org/KE/administrative-division-kenya.html
 */
class KeCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '110', // Nairobi Area
        '200', // Central
        '300', // Coast
        '400', // Eastern
        '500', // North Eastern
        '600', // Nyanza
        '700', // Rift Valley
        '800', // Western
    );

    public $compareIdentical = true;
}

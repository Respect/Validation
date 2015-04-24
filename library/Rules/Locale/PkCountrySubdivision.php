<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Pakistan country subdivision.
 *
 * ISO 3166-1 alpha-2: PK
 *
 * @link http://www.geonames.org/PK/administrative-division-pakistan.html
 */
class PkCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BA', // Balochistan
        'IS', // Islamabad Capital Territory
        'JK', // Azad Kashmir
        'NA', // Gilgit-Baltistan
        'NW', // Khyber Pakhtunkhwa
        'PB', // Punjab
        'SD', // Sindh
        'TA', // Federally Administered Tribal Areas
    );

    public $compareIdentical = true;
}

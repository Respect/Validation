<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Canada country subdivision.
 *
 * ISO 3166-1 alpha-2: CA
 *
 * @link http://www.geonames.org/CA/administrative-division-canada.html
 */
class CaCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AB', // Alberta
        'BC', // British Columbia
        'MB', // Manitoba
        'NB', // New Brunswick
        'NL', // Newfoundland and Labrador
        'NS', // Nova Scotia
        'NT', // Northwest Territories
        'NU', // Nunavut
        'ON', // Ontario
        'PE', // Prince Edward Island
        'QC', // Quebec
        'SK', // Saskatchewan
        'YT', // Yukon Territory
    );

    public $compareIdentical = true;
}

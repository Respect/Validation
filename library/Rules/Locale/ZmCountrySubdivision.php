<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Zambia country subdivision.
 *
 * ISO 3166-1 alpha-2: ZM
 *
 * @link http://www.geonames.org/ZM/administrative-division-zambia.html
 */
class ZmCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Western Province
        '02', // Central Province
        '03', // Eastern Province
        '04', // Luapula Province
        '05', // Northern Province
        '06', // North-Western Province
        '07', // Southern Province
        '08', // Copperbelt Province
        '09', // Lusaka Province
    );

    public $compareIdentical = true;
}

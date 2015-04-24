<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * São Tomé and Príncipe country subdivision.
 *
 * ISO 3166-1 alpha-2: ST
 *
 * @link http://www.geonames.org/ST/administrative-division-sao-tome-and-principe.html
 */
class StCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'P', // Principe
        'S', // Sao Tome
    );

    public $compareIdentical = true;
}

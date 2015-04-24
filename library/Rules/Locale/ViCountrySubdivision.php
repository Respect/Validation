<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * U.S. Virgin Islands country subdivision.
 *
 * ISO 3166-1 alpha-2: VI
 *
 * @link http://www.geonames.org/VI/administrative-division-u-s-virgin-islands.html
 */
class ViCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'C', // Saint Croix
        'J', // Saint John
        'T', // Saint Thomas
    );

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Grenada country subdivision.
 *
 * ISO 3166-1 alpha-2: GD
 *
 * @link http://www.geonames.org/GD/administrative-division-grenada.html
 */
class GdCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Saint Andrew
        '02', // Saint David
        '03', // Saint George
        '04', // Saint John
        '05', // Saint Mark
        '06', // Saint Patrick
        '10', // Southern Grenadine Islands
    );

    public $compareIdentical = true;
}

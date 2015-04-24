<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Saint Vincent and the Grenadines country subdivision.
 *
 * ISO 3166-1 alpha-2: VC
 *
 * @link http://www.geonames.org/VC/administrative-division-saint-vincent-and-the-grenadines.html
 */
class VcCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Charlotte
        '02', // Saint Andrew
        '03', // Saint David
        '04', // Saint George
        '05', // Saint Patrick
        '06', // Grenadines
    );

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Dominica country subdivision.
 *
 * ISO 3166-1 alpha-2: DM
 *
 * @link http://www.geonames.org/DM/administrative-division-dominica.html
 */
class DmCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '02', // Saint Andrew Parish
        '03', // Saint David Parish
        '04', // Saint George Parish
        '05', // Saint John Parish
        '06', // Saint Joseph Parish
        '07', // Saint Luke Parish
        '08', // Saint Mark Parish
        '09', // Saint Patrick Parish
        '10', // Saint Paul Parish
        '11', // Saint Peter Parish
    );

    public $compareIdentical = true;
}

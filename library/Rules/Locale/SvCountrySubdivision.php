<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * El Salvador country subdivision.
 *
 * ISO 3166-1 alpha-2: SV
 *
 * @link http://www.geonames.org/SV/administrative-division-el-salvador.html
 */
class SvCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AH', // Ahuachapan
        'CA', // Cabanas
        'CH', // Chalatenango
        'CU', // Cuscatlan
        'LI', // La Libertad
        'MO', // Morazan
        'PA', // La Paz
        'SA', // Santa Ana
        'SM', // San Miguel
        'SO', // Sonsonate
        'SS', // San Salvador
        'SV', // San Vicente
        'UN', // La Union
        'US', // Usulutan
    );

    public $compareIdentical = true;
}

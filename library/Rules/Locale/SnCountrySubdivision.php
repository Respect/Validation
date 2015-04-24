<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Senegal country subdivision.
 *
 * ISO 3166-1 alpha-2: SN
 *
 * @link http://www.geonames.org/SN/administrative-division-senegal.html
 */
class SnCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'DB', // Diourbel
        'DK', // Dakar
        'FK', // Fatick
        'KA', // Kaffrine
        'KD', // Kolda
        'KE', // Kédougou
        'KL', // Kaolack
        'LG', // Louga
        'MT', // Matam
        'SE', // Sédhiou
        'SL', // Saint-Louis
        'TC', // Tambacounda
        'TH', // Thies
        'ZG', // Ziguinchor
    );

    public $compareIdentical = true;
}

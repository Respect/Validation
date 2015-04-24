<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Papua New Guinea country subdivision.
 *
 * ISO 3166-1 alpha-2: PG
 *
 * @link http://www.geonames.org/PG/administrative-division-papua-new-guinea.html
 */
class PgCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'CPK', // Chimbu
        'CPM', // Central
        'EBR', // East New Britain
        'EHG', // Eastern Highlands
        'EPW', // Enga
        'ESW', // East Sepik
        'GPK', // Gulf
        'MBA', // Milne Bay
        'MPL', // Morobe
        'MPM', // Madang
        'MRL', // Manus
        'NCD', // National Capital
        'NIK', // New Ireland
        'NPP', // Northern
        'NSA', // Bougainville
        'SAN', // Sandaun
        'SHM', // Southern Highlands
        'WBK', // West New Britain
        'WHM', // Western Highlands
        'WPD', // Western
    );

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Saint Kitts and Nevis country subdivision.
 *
 * ISO 3166-1 alpha-2: KN
 *
 * @link http://www.geonames.org/KN/administrative-division-saint-kitts-and-nevis.html
 */
class KnCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'K', // Saint Kitts
        'N', // Nevis
        '01', // Christ Church Nichola Town
        '02', // Saint Anne Sandy Point
        '03', // Saint George Basseterre
        '04', // Saint George Gingerland
        '05', // Saint James Windward
        '06', // Saint John Capesterre
        '07', // Saint John Figtree
        '08', // Saint Mary Cayon
        '09', // Saint Paul Capesterre
        '10', // Saint Paul Charlestown
        '11', // Saint Peter Basseterre
        '12', // Saint Thomas Lowland
        '13', // Saint Thomas Middle Island
        '15', // Trinity Palmetto Point
    );

    public $compareIdentical = true;
}

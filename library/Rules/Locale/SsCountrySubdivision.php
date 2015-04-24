<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * South Sudan country subdivision.
 *
 * ISO 3166-1 alpha-2: SS
 *
 * @link http://www.geonames.org/SS/administrative-division-south-sudan.html
 */
class SsCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BN', // Northern Bahr el Ghazal
        'BW', // Western Bahr el Ghazal
        'EC', // Central Equatoria
        'EE', // Eastern Equatoria
        'EW', // Western Equatoria
        'JG', // Jonglei
        'LK', // Lakes
        'NU', // Upper Nile
        'UY', // Unity
        'WR', // Warrap
    );

    public $compareIdentical = true;
}

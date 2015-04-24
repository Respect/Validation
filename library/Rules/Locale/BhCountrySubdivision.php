<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Bahrain country subdivision.
 *
 * ISO 3166-1 alpha-2: BH
 *
 * @link http://www.geonames.org/BH/administrative-division-bahrain.html
 */
class BhCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '13', // Capital
        '14', // Southern
        '15', // Muharraq
        '16', // Central
        '17', // Northern
    );

    public $compareIdentical = true;
}

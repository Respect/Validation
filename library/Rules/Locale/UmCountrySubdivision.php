<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * U.S. Minor Outlying Islands country subdivision.
 *
 * ISO 3166-1 alpha-2: UM
 *
 * @link http://www.geonames.org/UM/administrative-division-united-states-minor-outlying-islands.html
 */
class UmCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '67', // Johnston Atoll
        '71', // Midway Atoll
        '76', // Navassa Island
        '79', // Wake Island
        '81', // Baker Island
        '84', // Howland Island
        '86', // Jarvis Island
        '89', // Kingman Reef
        '95', // Palmyra Atoll
    );

    public $compareIdentical = true;
}

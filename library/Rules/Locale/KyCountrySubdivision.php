<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Cayman Islands country subdivision.
 *
 * ISO 3166-1 alpha-2: KY
 *
 * @link http://www.geonames.org/KY/administrative-division-cayman-islands.html
 */
class KyCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'CR', // Creek
        'EA', // Eastern
        'ML', // Midland
        'SK', // Stake Bay
        'SP', // Spot Bay
        'ST', // South Town
        'WD', // West End
        'WN', // Western
    );

    public $compareIdentical = true;
}

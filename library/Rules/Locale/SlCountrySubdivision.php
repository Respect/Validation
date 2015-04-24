<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Sierra Leone country subdivision.
 *
 * ISO 3166-1 alpha-2: SL
 *
 * @link http://www.geonames.org/SL/administrative-division-sierra-leone.html
 */
class SlCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'E', // Eastern
        'N', // Northern
        'S', // Southern
        'W', // Western
    );

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Australia country subdivision.
 *
 * ISO 3166-1 alpha-2: AU
 *
 * @link http://www.geonames.org/AU/administrative-division-australia.html
 */
class AuCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'ACT', // Australian Capital Territory
        'NSW', // New South Wales
        'NT', // Northern Territory
        'QLD', // Queensland
        'SA', // South Australia
        'TAS', // Tasmania
        'VIC', // Victoria
        'WA', // Western Australia
    );

    public $compareIdentical = true;
}

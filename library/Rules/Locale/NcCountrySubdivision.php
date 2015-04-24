<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * New Caledonia country subdivision.
 *
 * ISO 3166-1 alpha-2: NC
 *
 * @link http://www.geonames.org/NC/administrative-division-new-caledonia.html
 */
class NcCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'L', // Iles Loyaute
        'N', // Nord
        'S', // Sud
    );

    public $compareIdentical = true;
}

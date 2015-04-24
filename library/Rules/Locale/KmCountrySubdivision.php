<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Comoros country subdivision.
 *
 * ISO 3166-1 alpha-2: KM
 *
 * @link http://www.geonames.org/KM/administrative-division-comoros.html
 */
class KmCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'A', // Anjouan
        'G', // Grande Comore
        'M', // Moheli
    );

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Vatican City country subdivision.
 *
 * ISO 3166-1 alpha-2: VA
 *
 * @link http://www.geonames.org/VA/administrative-division-vatican-city.html
 */
class VaCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

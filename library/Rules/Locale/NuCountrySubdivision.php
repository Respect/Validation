<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Niue country subdivision.
 *
 * ISO 3166-1 alpha-2: NU
 *
 * @link http://www.geonames.org/NU/administrative-division-niue.html
 */
class NuCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Guam country subdivision.
 *
 * ISO 3166-1 alpha-2: GU
 *
 * @link http://www.geonames.org/GU/administrative-division-guam.html
 */
class GuCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

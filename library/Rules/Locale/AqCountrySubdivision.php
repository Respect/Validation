<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Antarctica country subdivision.
 *
 * ISO 3166-1 alpha-2: AQ
 *
 * @link http://www.geonames.org/AQ/administrative-division-antarctica.html
 */
class AqCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

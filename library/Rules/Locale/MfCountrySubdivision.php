<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Saint Martin country subdivision.
 *
 * ISO 3166-1 alpha-2: MF
 *
 * @link http://www.geonames.org/MF/administrative-division-saint-martin.html
 */
class MfCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

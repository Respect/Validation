<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * French Guiana country subdivision.
 *
 * ISO 3166-1 alpha-2: GF
 *
 * @link http://www.geonames.org/GF/administrative-division-french-guiana.html
 */
class GfCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Saint Pierre and Miquelon country subdivision.
 *
 * ISO 3166-1 alpha-2: PM
 *
 * @link http://www.geonames.org/PM/administrative-division-saint-pierre-and-miquelon.html
 */
class PmCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'M', // Miquelon
        'P', // Saint Pierre
    );

    public $compareIdentical = true;
}

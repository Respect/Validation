<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Tajikistan country subdivision.
 *
 * ISO 3166-1 alpha-2: TJ
 *
 * @link http://www.geonames.org/TJ/administrative-division-tajikistan.html
 */
class TjCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'GB', // Gorno-Badakhstan
        'KT', // Khatlon
        'SU', // Sughd
    );

    public $compareIdentical = true;
}

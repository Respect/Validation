<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Svalbard and Jan Mayen country subdivision.
 *
 * ISO 3166-1 alpha-2: SJ
 *
 * @link http://www.geonames.org/SJ/administrative-division-svalbard-and-jan-mayen.html
 */
class SjCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '21', // Svalbard
        '22', // Jan Mayen
    );

    public $compareIdentical = true;
}

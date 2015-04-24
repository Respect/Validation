<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Tonga country subdivision.
 *
 * ISO 3166-1 alpha-2: TO
 *
 * @link http://www.geonames.org/TO/administrative-division-tonga.html
 */
class ToCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Eua
        '02', // Ha'apai
        '03', // Niuas
        '04', // Tongatapu
        '05', // Vava'u
    );

    public $compareIdentical = true;
}

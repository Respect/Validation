<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Brunei country subdivision.
 *
 * ISO 3166-1 alpha-2: BN
 *
 * @link http://www.geonames.org/BN/administrative-division-brunei.html
 */
class BnCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BE', // Belait
        'BM', // Brunei and Muara
        'TE', // Temburong
        'TU', // Tutong
    );

    public $compareIdentical = true;
}

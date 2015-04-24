<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Swaziland country subdivision.
 *
 * ISO 3166-1 alpha-2: SZ
 *
 * @link http://www.geonames.org/SZ/administrative-division-swaziland.html
 */
class SzCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'HH', // Hhohho
        'LU', // Lubombo
        'MA', // Manzini
        'SH', // Shishelweni
    );

    public $compareIdentical = true;
}

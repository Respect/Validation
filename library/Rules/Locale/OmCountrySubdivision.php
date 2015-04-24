<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Oman country subdivision.
 *
 * ISO 3166-1 alpha-2: OM
 *
 * @link http://www.geonames.org/OM/administrative-division-oman.html
 */
class OmCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BA', // Al Batinah South
        'BU', // Al Buraymī
        'DA', // Ad Dakhiliyah
        'MA', // Masqat
        'MU', // Musandam
        'SH', // Ash Sharqiyah South
        'WU', // Al Wusta
        'ZA', // Az Zahirah
        'ZU', // Zufar
    );

    public $compareIdentical = true;
}

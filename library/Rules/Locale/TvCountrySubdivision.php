<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Tuvalu country subdivision.
 *
 * ISO 3166-1 alpha-2: TV
 *
 * @link http://www.geonames.org/TV/administrative-division-tuvalu.html
 */
class TvCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'FUN', // Funafuti
        'NIT', // Niutao
        'NKF', // Nukufetau
        'NKL', // Nukulaelae
        'NMA', // Nanumea
        'NMG', // Nanumanga
        'NUI', // Nui
        'VAI', // Vaitupu
    );

    public $compareIdentical = true;
}

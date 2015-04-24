<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Kuwait country subdivision.
 *
 * ISO 3166-1 alpha-2: KW
 *
 * @link http://www.geonames.org/KW/administrative-division-kuwait.html
 */
class KwCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AH', // Al Ahmadi
        'FA', // Al Farwaniyah
        'HA', // Hawalli
        'JA', // Al Jahra
        'KU', // Al Asimah
        'MU', // Mubārak al Kabīr
    );

    public $compareIdentical = true;
}

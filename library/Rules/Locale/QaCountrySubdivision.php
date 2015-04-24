<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Qatar country subdivision.
 *
 * ISO 3166-1 alpha-2: QA
 *
 * @link http://www.geonames.org/QA/administrative-division-qatar.html
 */
class QaCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'DA', // Ad Dawhah
        'KH', // Al Khawr wa adh Dhakhīrah
        'MS', // Ash Shamāl
        'RA', // Ar Rayyan
        'US', // Umm Salal
        'WA', // Al Wakrah
        'ZA', // Az Z a‘āyin
    );

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Gambia country subdivision.
 *
 * ISO 3166-1 alpha-2: GM
 *
 * @link http://www.geonames.org/GM/administrative-division-gambia.html
 */
class GmCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'B', // Banjul
        'L', // Lower River
        'M', // Central River
        'N', // North Bank
        'U', // Upper River
        'W', // Western
    );

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Cyprus country subdivision.
 *
 * ISO 3166-1 alpha-2: CY
 *
 * @link http://www.geonames.org/CY/administrative-division-cyprus.html
 */
class CyCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Lefkosía
        '02', // Lemesós
        '03', // Lárnaka
        '04', // Ammóchostos
        '05', // Páfos
        '06', // Kerýneia
    );

    public $compareIdentical = true;
}

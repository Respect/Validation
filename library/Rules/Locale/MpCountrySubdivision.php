<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Northern Mariana Islands country subdivision.
 *
 * ISO 3166-1 alpha-2: MP
 *
 * @link http://www.geonames.org/MP/administrative-division-northern-mariana-islands.html
 */
class MpCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'N', // Northern Islands
        'R', // Rota
        'S', // Saipan
        'T', // Tinian
    );

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Tokelau country subdivision.
 *
 * ISO 3166-1 alpha-2: TK
 *
 * @link http://www.geonames.org/TK/administrative-division-tokelau.html
 */
class TkCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'A', // Atafu
        'F', // Fakaofo
        'N', // Nukunonu
    );

    public $compareIdentical = true;
}

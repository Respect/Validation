<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Luxembourg country subdivision.
 *
 * ISO 3166-1 alpha-2: LU
 *
 * @link http://www.geonames.org/LU/administrative-division-luxembourg.html
 */
class LuCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'D', // Diekirch
        'G', // Grevenmacher
        'L', // Luxembourg
    );

    public $compareIdentical = true;
}

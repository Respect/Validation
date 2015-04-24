<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Guinea-Bissau country subdivision.
 *
 * ISO 3166-1 alpha-2: GW
 *
 * @link http://www.geonames.org/GW/administrative-division-guinea-bissau.html
 */
class GwCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'L', // Leste
        'N', // Norte
        'S', // Sul
        'BA', // Bafata Region
        'BL', // Bolama Region
        'BM', // Biombo Region
        'BS', // Bissau Region
        'CA', // Cacheu Region
        'GA', // Gabu Region
        'OI', // Oio Region
        'QU', // Quinara Region
        'TO', // Tombali Region
    );

    public $compareIdentical = true;
}

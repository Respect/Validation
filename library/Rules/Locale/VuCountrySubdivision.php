<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Vanuatu country subdivision.
 *
 * ISO 3166-1 alpha-2: VU
 *
 * @link http://www.geonames.org/VU/administrative-division-vanuatu.html
 */
class VuCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'MAP', // Malampa
        'PAM', // Penama
        'SAM', // Sanma
        'SEE', // Shefa
        'TAE', // Tafea
        'TOB', // Torba
    );

    public $compareIdentical = true;
}

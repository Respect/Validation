<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Lesotho country subdivision.
 *
 * ISO 3166-1 alpha-2: LS
 *
 * @link http://www.geonames.org/LS/administrative-division-lesotho.html
 */
class LsCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'A', // Maseru
        'B', // Butha-Buthe
        'C', // Leribe
        'D', // Berea
        'E', // Mafeteng
        'F', // Mohale's Hoek
        'G', // Quthing
        'H', // Qacha's Nek
        'J', // Mokhotlong
        'K', // Thaba-Tseka
    );

    public $compareIdentical = true;
}

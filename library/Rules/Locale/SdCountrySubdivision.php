<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Sudan country subdivision.
 *
 * ISO 3166-1 alpha-2: SD
 *
 * @link http://www.geonames.org/SD/administrative-division-sudan.html
 */
class SdCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'DC', // Wasaţ Dārfūr
        'DE', // Sharq Dārfūr
        'DN', // Shamāl Dārfūr
        'DS', // Janūb Dārfūr
        'DW', // Gharb Dārfūr
        'GD', // Al Qaḑārif
        'GZ', // Al Jazīrah
        'KA', // Kassalā
        'KH', // Al Kharţūm
        'KN', // Shamāl Kurdufān
        'KS', // Janūb Kurdufān
        'NB', // An Nīl al Azraq
        'NO', // Ash Shamālīyah
        'NR', // An Nīl
        'NW', // An Nīl al Abyaḑ
        'RS', // Al Baḩr al Aḩmar
        'SI', // Sinnār
    );

    public $compareIdentical = true;
}

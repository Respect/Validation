<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Saudi Arabia country subdivision.
 *
 * ISO 3166-1 alpha-2: SA
 *
 * @link http://www.geonames.org/SA/administrative-division-saudi-arabia.html
 */
class SaCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Ar Riyad
        '02', // Makkah
        '03', // Al Madinah
        '04', // Ash Sharqiyah (Eastern Province)
        '05', // Al Qasim
        '06', // Ha'il
        '07', // Tabuk
        '08', // Al Hudud ash Shamaliyah
        '09', // Jizan
        '10', // Najran
        '11', // Al Bahah
        '12', // Al Jawf
        '14', // 'Asir
    );

    public $compareIdentical = true;
}

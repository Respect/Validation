<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Iraq country subdivision.
 *
 * ISO 3166-1 alpha-2: IQ
 *
 * @link http://www.geonames.org/IQ/administrative-division-iraq.html
 */
class IqCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AN', // Al Anbar
        'AR', // Arbīl
        'BA', // Al Basrah
        'BB', // Babil
        'BG', // Baghdad
        'DA', // Dahūk
        'DI', // Diyala
        'DQ', // Dhi Qar
        'KA', // Al Karbala
        'MA', // Maysan
        'MU', // Al Muthanna
        'NA', // An Najaf
        'NI', // Ninawa
        'QA', // Al Qadisyah
        'SD', // Salah ad Din
        'SU', // As Sulaymānīyah
        'TS', // Kirkūk
        'WA', // Wasit
    );

    public $compareIdentical = true;
}

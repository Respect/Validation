<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Mali country subdivision.
 *
 * ISO 3166-1 alpha-2: ML
 *
 * @link http://www.geonames.org/ML/administrative-division-mali.html
 */
class MlCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '1', // Kayes
        '2', // Koulikoro
        '3', // Sikasso
        '4', // Segou
        '5', // Mopti
        '6', // Tombouctou
        '7', // Gao
        '8', // Kidal
        'BKO', // Bamako Capital District
    );

    public $compareIdentical = true;
}

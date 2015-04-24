<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Kyrgyzstan country subdivision.
 *
 * ISO 3166-1 alpha-2: KG
 *
 * @link http://www.geonames.org/KG/administrative-division-kyrgyzstan.html
 */
class KgCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'B', // Batken
        'C', // Chu
        'GB', // Bishkek
        'J', // Jalal-Abad
        'N', // Naryn
        'O', // Osh
        'T', // Talas
        'Y', // Ysyk-Kol
    );

    public $compareIdentical = true;
}

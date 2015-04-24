<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Lebanon country subdivision.
 *
 * ISO 3166-1 alpha-2: LB
 *
 * @link http://www.geonames.org/LB/administrative-division-lebanon.html
 */
class LbCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AK', // Aakkâr
        'AS', // Liban-Nord
        'BA', // Beyrouth
        'BH', // Baalbek-Hermel
        'BI', // Béqaa
        'JA', // Liban-Sud
        'JL', // Mont-Liban
        'NA', // Nabatîyé
    );

    public $compareIdentical = true;
}

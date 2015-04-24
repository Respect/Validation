<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Cameroon country subdivision.
 *
 * ISO 3166-1 alpha-2: CM
 *
 * @link http://www.geonames.org/CM/administrative-division-cameroon.html
 */
class CmCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AD', // Adamawa Province (Adamaoua)
        'CE', // Centre Province
        'EN', // Extreme North Province (Extrême-Nord)
        'ES', // East Province (Est)
        'LT', // Littoral Province
        'NO', // North Province (Nord)
        'NW', // Northwest Province (Nord-Ouest)
        'OU', // West Province (Ouest)
        'SU', // South Province (Sud)
        'SW', // Southwest Province (Sud-Ouest).
    );

    public $compareIdentical = true;
}

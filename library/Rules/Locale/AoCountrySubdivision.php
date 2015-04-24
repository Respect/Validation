<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Angola country subdivision.
 *
 * ISO 3166-1 alpha-2: AO
 *
 * @link http://www.geonames.org/AO/administrative-division-angola.html
 */
class AoCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BGO', // Bengo
        'BGU', // Benguela province
        'BIE', // Bie
        'CAB', // Cabinda
        'CCU', // Cuando-Cubango
        'CNN', // Cunene
        'CNO', // Cuanza Norte
        'CUS', // Cuanza Sul
        'HUA', // Huambo province
        'HUI', // Huila province
        'LNO', // Lunda Norte
        'LSU', // Lunda Sul
        'LUA', // Luanda
        'MAL', // Malange
        'MOX', // Moxico
        'NAM', // Namibe
        'UIG', // Uige
        'ZAI', // Zaire
    );

    public $compareIdentical = true;
}

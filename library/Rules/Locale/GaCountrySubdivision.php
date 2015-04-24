<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Gabon country subdivision.
 *
 * ISO 3166-1 alpha-2: GA
 *
 * @link http://www.geonames.org/GA/administrative-division-gabon.html
 */
class GaCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '1', // Estuaire
        '2', // Haut-Ogooue
        '3', // Moyen-Ogooue
        '4', // Ngounie
        '5', // Nyanga
        '6', // Ogooue-Ivindo
        '7', // Ogooue-Lolo
        '8', // Ogooue-Maritime
        '9', // Woleu-Ntem
    );

    public $compareIdentical = true;
}

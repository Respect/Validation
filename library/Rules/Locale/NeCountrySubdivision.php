<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Niger country subdivision.
 *
 * ISO 3166-1 alpha-2: NE
 *
 * @link http://www.geonames.org/NE/administrative-division-niger.html
 */
class NeCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '1', // Agadez
        '2', // Diffa
        '3', // Dosso
        '4', // Maradi
        '5', // Tahoua
        '6', // Tillabéri
        '7', // Zinder
        '8', // Niamey
    );

    public $compareIdentical = true;
}

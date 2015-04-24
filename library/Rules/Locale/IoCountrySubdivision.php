<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * British Indian Ocean Territory country subdivision.
 *
 * ISO 3166-1 alpha-2: IO
 *
 * @link http://www.geonames.org/IO/administrative-division-british-indian-ocean-territory.html
 */
class IoCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'DG', // Diego Garcia
        'DI', // Danger Island
        'EA', // Eagle Islands
        'EG', // Egmont Islands
        'NI', // Nelsons Island
        'PB', // Peros Banhos
        'SI', // Salomon Islands
        'TB', // Three Brothers
    );

    public $compareIdentical = true;
}

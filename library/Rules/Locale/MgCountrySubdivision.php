<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Madagascar country subdivision.
 *
 * ISO 3166-1 alpha-2: MG
 *
 * @link http://www.geonames.org/MG/administrative-division-madagascar.html
 */
class MgCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'A', // Toamasina province
        'D', // Antsiranana province
        'F', // Fianarantsoa province
        'M', // Mahajanga province
        'T', // Antananarivo province
        'U', // Toliara province
    );

    public $compareIdentical = true;
}

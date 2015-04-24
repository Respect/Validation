<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Botswana country subdivision.
 *
 * ISO 3166-1 alpha-2: BW
 *
 * @link http://www.geonames.org/BW/administrative-division-botswana.html
 */
class BwCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'CE', // Central
        'GH', // Ghanzi
        'KG', // Kgalagadi
        'KL', // Kgatleng
        'KW', // Kweneng
        'NE', // North East
        'NW', // North West
        'SE', // South East
        'SO', // Southern
    );

    public $compareIdentical = true;
}

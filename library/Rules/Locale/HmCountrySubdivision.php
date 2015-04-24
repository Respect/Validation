<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Heard Island and McDonald Islands country subdivision.
 *
 * ISO 3166-1 alpha-2: HM
 *
 * @link http://www.geonames.org/HM/administrative-division-heard-island-and-mcdonald-islands.html
 */
class HmCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'F', // Flat Island
        'H', // Heard Island
        'M', // McDonald Island
        'S', // Shag Island
    );

    public $compareIdentical = true;
}

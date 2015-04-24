<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Belize country subdivision.
 *
 * ISO 3166-1 alpha-2: BZ
 *
 * @link http://www.geonames.org/BZ/administrative-division-belize.html
 */
class BzCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BZ', // Belize District
        'CY', // Cayo District
        'CZL', // Corozal District
        'OW', // Orange Walk District
        'SC', // Stann Creek District
        'TOL', // Toledo District
    );

    public $compareIdentical = true;
}

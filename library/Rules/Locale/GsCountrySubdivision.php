<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * South Georgia and the South Sandwich Islands country subdivision.
 *
 * ISO 3166-1 alpha-2: GS
 *
 * @link http://www.geonames.org/GS/administrative-division-south-georgia-and-the-south-sandwich-islands.html
 */
class GsCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

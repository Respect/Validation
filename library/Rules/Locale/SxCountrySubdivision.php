<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Sint Maarten country subdivision.
 *
 * ISO 3166-1 alpha-2: SX
 *
 * @link http://www.geonames.org/SX/administrative-division-sint-maarten.html
 */
class SxCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

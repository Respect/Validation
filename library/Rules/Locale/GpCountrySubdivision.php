<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Guadeloupe country subdivision.
 *
 * ISO 3166-1 alpha-2: GP
 *
 * @link http://www.geonames.org/GP/administrative-division-guadeloupe.html
 */
class GpCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

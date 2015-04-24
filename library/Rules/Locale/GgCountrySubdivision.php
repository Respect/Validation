<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Guernsey country subdivision.
 *
 * ISO 3166-1 alpha-2: GG
 *
 * @link http://www.geonames.org/GG/administrative-division-guernsey.html
 */
class GgCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

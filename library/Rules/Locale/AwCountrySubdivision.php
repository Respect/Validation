<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Aruba country subdivision.
 *
 * ISO 3166-1 alpha-2: AW
 *
 * @link http://www.geonames.org/AW/administrative-division-aruba.html
 */
class AwCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Kosovo country subdivision.
 *
 * ISO 3166-1 alpha-2: XK
 *
 * @link http://www.geonames.org/XK/administrative-division-kosovo.html
 */
class XkCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

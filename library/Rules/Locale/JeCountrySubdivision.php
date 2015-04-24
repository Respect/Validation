<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Jersey country subdivision.
 *
 * ISO 3166-1 alpha-2: JE
 *
 * @link http://www.geonames.org/JE/administrative-division-jersey.html
 */
class JeCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

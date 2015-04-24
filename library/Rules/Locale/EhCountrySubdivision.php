<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Western Sahara country subdivision.
 *
 * ISO 3166-1 alpha-2: EH
 *
 * @link http://www.geonames.org/EH/administrative-division-western-sahara.html
 */
class EhCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

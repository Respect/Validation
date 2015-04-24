<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Isle of Man country subdivision.
 *
 * ISO 3166-1 alpha-2: IM
 *
 * @link http://www.geonames.org/IM/administrative-division-isle-of-man.html
 */
class ImCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

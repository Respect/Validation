<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Gibraltar country subdivision.
 *
 * ISO 3166-1 alpha-2: GI
 *
 * @link http://www.geonames.org/GI/administrative-division-gibraltar.html
 */
class GiCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

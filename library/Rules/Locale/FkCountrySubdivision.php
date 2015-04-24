<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Falkland Islands country subdivision.
 *
 * ISO 3166-1 alpha-2: FK
 *
 * @link http://www.geonames.org/FK/administrative-division-falkland-islands.html
 */
class FkCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

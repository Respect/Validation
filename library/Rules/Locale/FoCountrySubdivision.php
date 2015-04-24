<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Faroe Islands country subdivision.
 *
 * ISO 3166-1 alpha-2: FO
 *
 * @link http://www.geonames.org/FO/administrative-division-faroe-islands.html
 */
class FoCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

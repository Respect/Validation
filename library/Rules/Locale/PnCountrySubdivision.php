<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Pitcairn Islands country subdivision.
 *
 * ISO 3166-1 alpha-2: PN
 *
 * @link http://www.geonames.org/PN/administrative-division-pitcairn-islands.html
 */
class PnCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

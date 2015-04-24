<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Anguilla country subdivision.
 *
 * ISO 3166-1 alpha-2: AI
 *
 * @link http://www.geonames.org/AI/administrative-division-anguilla.html
 */
class AiCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

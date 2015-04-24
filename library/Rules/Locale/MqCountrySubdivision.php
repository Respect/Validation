<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Martinique country subdivision.
 *
 * ISO 3166-1 alpha-2: MQ
 *
 * @link http://www.geonames.org/MQ/administrative-division-martinique.html
 */
class MqCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(null, '');

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Bonaire country subdivision.
 *
 * ISO 3166-1 alpha-2: BQ
 *
 * @link http://www.geonames.org/BQ/administrative-division-bonaire.html
 */
class BqCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BO', // Bonaire
        'SA', // Saba
        'SE', // Sint Eustatius
    );

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Saint Lucia country subdivision.
 *
 * ISO 3166-1 alpha-2: LC
 *
 * @link http://www.geonames.org/LC/administrative-division-saint-lucia.html
 */
class LcCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AR', // Anse-la-Raye
        'CA', // Castries
        'CH', // Choiseul
        'DA', // Dauphin
        'DE', // Dennery
        'GI', // Gros-Islet
        'LA', // Laborie
        'MI', // Micoud
        'PR', // Praslin
        'SO', // Soufriere
        'VF', // Vieux-Fort
    );

    public $compareIdentical = true;
}

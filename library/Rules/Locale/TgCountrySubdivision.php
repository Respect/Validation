<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Togo country subdivision.
 *
 * ISO 3166-1 alpha-2: TG
 *
 * @link http://www.geonames.org/TG/administrative-division-togo.html
 */
class TgCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'C', // Centrale
        'K', // Kara
        'M', // Maritime
        'P', // Plateaux
        'S', // Savanes
    );

    public $compareIdentical = true;
}

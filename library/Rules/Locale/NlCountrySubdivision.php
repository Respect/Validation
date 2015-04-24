<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Netherlands country subdivision.
 *
 * ISO 3166-1 alpha-2: NL
 *
 * @link http://www.geonames.org/NL/administrative-division-netherlands.html
 */
class NlCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'DR', // Drenthe
        'FL', // Flevoland
        'FR', // Friesland
        'GE', // Gelderland
        'GR', // Groningen
        'LI', // Limburg
        'NB', // Noord Brabant
        'NH', // Noord Holland
        'OV', // Overijssel
        'UT', // Utrecht
        'ZE', // Zeeland
        'ZH', // Zuid Holland
    );

    public $compareIdentical = true;
}

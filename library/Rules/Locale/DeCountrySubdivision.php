<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Germany country subdivision.
 *
 * ISO 3166-1 alpha-2: DE
 *
 * @link http://www.geonames.org/DE/administrative-division-germany.html
 */
class DeCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BB', // Brandenburg
        'BE', // Berlin
        'BW', // Baden-Württemberg
        'BY', // Bayern
        'HB', // Bremen
        'HE', // Hessen
        'HH', // Hamburg
        'MV', // Mecklenburg-Vorpommern
        'NI', // Niedersachsen
        'NW', // Nordrhein-Westfalen
        'RP', // Rheinland-Pfalz
        'SH', // Schleswig-Holstein
        'SL', // Saarland
        'SN', // Sachsen
        'ST', // Sachsen-Anhalt
        'TH', // Thüringen
    );

    public $compareIdentical = true;
}

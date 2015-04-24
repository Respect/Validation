<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Liechtenstein country subdivision.
 *
 * ISO 3166-1 alpha-2: LI
 *
 * @link http://www.geonames.org/LI/administrative-division-liechtenstein.html
 */
class LiCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Balzers
        '02', // Eschen
        '03', // Gamprin
        '04', // Mauren
        '05', // Planken
        '06', // Ruggell
        '07', // Schaan
        '08', // Schellenberg
        '09', // Triesen
        '10', // Triesenberg
        '11', // Vaduz
    );

    public $compareIdentical = true;
}

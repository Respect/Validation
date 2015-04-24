<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Namibia country subdivision.
 *
 * ISO 3166-1 alpha-2: NA
 *
 * @link http://www.geonames.org/NA/administrative-division-namibia.html
 */
class NaCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'CA', // Caprivi
        'ER', // Erongo
        'HA', // Hardap
        'KA', // Karas
        'KH', // Khomas
        'KU', // Kunene
        'OD', // Otjozondjupa
        'OH', // Omaheke
        'ON', // Oshana
        'OS', // Omusati
        'OT', // Oshikoto
        'OW', // Ohangwena
        'OK', // Kavango
    );

    public $compareIdentical = true;
}

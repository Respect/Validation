<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Nauru country subdivision.
 *
 * ISO 3166-1 alpha-2: NR
 *
 * @link http://www.geonames.org/NR/administrative-division-nauru.html
 */
class NrCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Aiwo
        '02', // Anabar
        '03', // Anetan
        '04', // Anibare
        '05', // Baiti
        '06', // Boe
        '07', // Buada
        '08', // Denigomodu
        '09', // Ewa
        '10', // Ijuw
        '11', // Meneng
        '12', // Nibok
        '13', // Uaboe
        '14', // Yaren
    );

    public $compareIdentical = true;
}

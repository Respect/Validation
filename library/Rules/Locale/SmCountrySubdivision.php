<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * San Marino country subdivision.
 *
 * ISO 3166-1 alpha-2: SM
 *
 * @link http://www.geonames.org/SM/administrative-division-san-marino.html
 */
class SmCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Acquaviva
        '02', // Chiesanuova
        '03', // Domagnano
        '04', // Faetano
        '05', // Fiorentino
        '06', // Borgo Maggiore
        '07', // Citta di San Marino
        '08', // Montegiardino
        '09', // Serravalle
    );

    public $compareIdentical = true;
}

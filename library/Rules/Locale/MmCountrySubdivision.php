<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Myanmar [Burma] country subdivision.
 *
 * ISO 3166-1 alpha-2: MM
 *
 * @link http://www.geonames.org/MM/administrative-division-myanmar.html
 */
class MmCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Sagaing
        '02', // Bago
        '03', // Magway
        '04', // Mandalay
        '05', // Tanintharyi
        '06', // Yangon
        '07', // Ayeyarwady
        '11', // Kachin State
        '12', // Kayah State
        '13', // Kayin State
        '14', // Chin State
        '15', // Mon State
        '16', // Rakhine State
        '17', // Shan State
    );

    public $compareIdentical = true;
}

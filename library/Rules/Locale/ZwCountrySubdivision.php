<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Zimbabwe country subdivision.
 *
 * ISO 3166-1 alpha-2: ZW
 *
 * @link http://www.geonames.org/ZW/administrative-division-zimbabwe.html
 */
class ZwCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'BU', // Bulawayo (city)
        'HA', // Harare (city)
        'MA', // Manicaland
        'MC', // Mashonaland Central
        'ME', // Mashonaland East
        'MI', // Midlands
        'MN', // Matabeleland North
        'MS', // Matabeleland South
        'MV', // Masvingo
        'MW', // Mashonaland West
    );

    public $compareIdentical = true;
}

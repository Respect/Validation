<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Jordan country subdivision.
 *
 * ISO 3166-1 alpha-2: JO
 *
 * @link http://www.geonames.org/JO/administrative-division-jordan.html
 */
class JoCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AJ', // Ajlun
        'AM', // 'Amman
        'AQ', // Al 'Aqabah
        'AT', // At Tafilah
        'AZ', // Az Zarqa'
        'BA', // Al Balqa'
        'IR', // Irbid
        'JA', // Jarash
        'KA', // Al Karak
        'MA', // Al Mafraq
        'MD', // Madaba
        'MN', // Ma'an
    );

    public $compareIdentical = true;
}

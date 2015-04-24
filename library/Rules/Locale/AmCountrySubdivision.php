<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Armenia country subdivision.
 *
 * ISO 3166-1 alpha-2: AM
 *
 * @link http://www.geonames.org/AM/administrative-division-armenia.html
 */
class AmCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AG', // Aragatsotn
        'AR', // Ararat
        'AV', // Armavir
        'ER', // Yerevan
        'GR', // Geghark'unik'
        'KT', // Kotayk'
        'LO', // Lorri
        'SH', // Shirak
        'SU', // Syunik'
        'TV', // Tavush
        'VD', // Vayots' Dzor
    );

    public $compareIdentical = true;
}

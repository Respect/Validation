<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Iceland country subdivision.
 *
 * ISO 3166-1 alpha-2: IS
 *
 * @link http://www.geonames.org/IS/administrative-division-iceland.html
 */
class IsCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '1', // Höfuðborgarsvæði
        '2', // Suðurnes
        '3', // Vesturland
        '4', // Vestfirðir
        '5', // Norðurland Vestra
        '6', // Norðurland Eystra
        '7', // Austurland
        '8', // Suðurland
    );

    public $compareIdentical = true;
}

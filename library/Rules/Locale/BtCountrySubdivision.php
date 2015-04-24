<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Bhutan country subdivision.
 *
 * ISO 3166-1 alpha-2: BT
 *
 * @link http://www.geonames.org/BT/administrative-division-bhutan.html
 */
class BtCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '11', // Paro
        '12', // Chukha
        '13', // Haa
        '14', // Samtse
        '15', // Thimphu
        '21', // Tsirang
        '22', // Dagana
        '23', // Punakha
        '24', // Wangdue Phodrang
        '31', // Sarpang
        '32', // Trongsa
        '33', // Bumthang
        '34', // Zhemgang
        '41', // Trashigang
        '42', // Mongar
        '43', // Pemagatshel
        '44', // Lhuntse
        '45', // Samdrup Jongkhar
        'GA', // Gasa
        'TY', // Trashi Yangste
    );

    public $compareIdentical = true;
}

<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * East Timor country subdivision.
 *
 * ISO 3166-1 alpha-2: TL
 *
 * @link http://www.geonames.org/TL/administrative-division-east-timor.html
 */
class TlCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AL', // Aileu
        'AN', // Ainaro
        'BA', // Baucau
        'BO', // Bobonaro
        'CO', // Cova Lima
        'DI', // Dili
        'ER', // Ermera
        'LA', // Lautem
        'LI', // Liquica
        'MF', // Manufahi
        'MT', // Manatuto
        'OE', // Oecussi
        'VI', // Viqueque
    );

    public $compareIdentical = true;
}

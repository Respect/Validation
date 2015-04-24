<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Cook Islands country subdivision.
 *
 * ISO 3166-1 alpha-2: CK
 *
 * @link http://www.geonames.org/CK/administrative-division-cook-islands.html
 */
class CkCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AI', // Aitutaki
        'AT', // Atiu
        'MA', // Manuae
        'MG', // Mangaia
        'MK', // Manihiki
        'MT', // Mitiaro
        'MU', // Mauke
        'NI', // Nassau Island
        'PA', // Palmerston
        'PE', // Penrhyn
        'PU', // Pukapuka
        'RK', // Rakahanga
        'RR', // Rarotonga
        'SU', // Surwarrow
        'TA', // Takutea
    );

    public $compareIdentical = true;
}

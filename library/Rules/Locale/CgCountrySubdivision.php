<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Republic of the Congo country subdivision.
 *
 * ISO 3166-1 alpha-2: CG
 *
 * @link http://www.geonames.org/CG/administrative-division-republic-of-the-congo.html
 */
class CgCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '11', // Bouenza
        '12', // Pool
        '13', // Sangha
        '14', // Plateaux
        '15', // Cuvette-Ouest
        '16', // Pointe-Noire
        '2', // Lekoumou
        '5', // Kouilou
        '7', // Likouala
        '8', // Cuvette
        '9', // Niari
        'BZV', // Brazzaville
    );

    public $compareIdentical = true;
}

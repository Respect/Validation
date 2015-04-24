<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Mauritius country subdivision.
 *
 * ISO 3166-1 alpha-2: MU
 *
 * @link http://www.geonames.org/MU/administrative-division-mauritius.html
 */
class MuCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AG', // Agalega Islands
        'BL', // Black River
        'BR', // Beau Bassin-Rose Hill
        'CC', // Cargados Carajos Shoals (Saint Brandon Islands)
        'CU', // Curepipe
        'FL', // Flacq
        'GP', // Grand Port
        'MO', // Moka
        'PA', // Pamplemousses
        'PL', // Port Louis
        'PU', // Port Louis
        'PW', // Plaines Wilhems
        'QB', // Quatre Bornes
        'RO', // Rodrigues
        'RR', // Riviere du Rempart
        'SA', // Savanne
        'VP', // Vacoas-Phoenix
    );

    public $compareIdentical = true;
}

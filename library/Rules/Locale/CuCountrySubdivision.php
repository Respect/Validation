<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Cuba country subdivision.
 *
 * ISO 3166-1 alpha-2: CU
 *
 * @link http://www.geonames.org/CU/administrative-division-cuba.html
 */
class CuCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Pinar del Rio
        '03', // La Habana
        '04', // Matanzas
        '05', // Villa Clara
        '06', // Cienfuegos
        '07', // Sancti Spiritus
        '08', // Ciego de Avila
        '09', // Camaguey
        '10', // Las Tunas
        '11', // Holguin
        '12', // Granma
        '13', // Santiago de Cuba
        '14', // Guantanamo
        '99', // Isla de la Juventud
        '02', // La Habana
    );

    public $compareIdentical = true;
}

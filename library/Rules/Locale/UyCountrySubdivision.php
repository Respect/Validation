<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Uruguay country subdivision.
 *
 * ISO 3166-1 alpha-2: UY
 *
 * @link http://www.geonames.org/UY/administrative-division-uruguay.html
 */
class UyCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AR', // Artigas
        'CA', // Canelones
        'CL', // Cerro Largo
        'CO', // Colonia
        'DU', // Durazno
        'FD', // Florida
        'FS', // Flores
        'LA', // Lavalleja
        'MA', // Maldonado
        'MO', // Montevideo
        'PA', // Paysandu
        'RN', // Rio Negro
        'RO', // Rocha
        'RV', // Rivera
        'SA', // Salto
        'SJ', // San Jose
        'SO', // Soriano
        'TA', // Tacuarembó
        'TT', // Treinta y Tres
    );

    public $compareIdentical = true;
}

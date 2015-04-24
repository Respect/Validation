<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Venezuela country subdivision.
 *
 * ISO 3166-1 alpha-2: VE
 *
 * @link http://www.geonames.org/VE/administrative-division-venezuela.html
 */
class VeCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'A', // Federal Capital
        'B', // Anzoategui
        'C', // Apure
        'D', // Aragua
        'E', // Barinas
        'F', // Bolivar
        'G', // Carabobo
        'H', // Cojedes
        'I', // Falcon
        'J', // Guarico
        'K', // Lara
        'L', // Merida
        'M', // Miranda
        'N', // Monagas
        'O', // Nueva Esparta
        'P', // Portuguesa
        'R', // Sucre
        'S', // Tachira
        'T', // Trujillo
        'U', // Yaracuy
        'V', // Zulia
        'W', // Federal Dependency
        'X', // Vargas
        'Y', // Delta Amacuro
        'Z', // Amazonas
    );

    public $compareIdentical = true;
}

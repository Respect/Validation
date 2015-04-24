<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Ecuador country subdivision.
 *
 * ISO 3166-1 alpha-2: EC
 *
 * @link http://www.geonames.org/EC/administrative-division-ecuador.html
 */
class EcCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'A', // Azuay
        'B', // Bolivar
        'C', // Carchi
        'D', // Orellana
        'E', // Esmeraldas
        'F', // Canar
        'G', // Guayas
        'H', // Chimborazo
        'I', // Imbabura
        'L', // Loja
        'M', // Manabi
        'N', // Napo
        'O', // El Oro
        'P', // Pichincha
        'R', // Los Rios
        'S', // Morona-Santiago
        'SD', // Santo Domingo de los Tsáchilas
        'SE', // Santa Elena
        'T', // Tungurahua
        'U', // Sucumbios
        'W', // Galapagos
        'X', // Cotopaxi
        'Y', // Pastaza
        'Z', // Zamora-Chinchipe
    );

    public $compareIdentical = true;
}

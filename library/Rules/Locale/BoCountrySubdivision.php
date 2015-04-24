<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Bolivia country subdivision.
 *
 * ISO 3166-1 alpha-2: BO
 *
 * @link http://www.geonames.org/BO/administrative-division-bolivia.html
 */
class BoCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'B', // Departmento Beni
        'C', // Departmento Cochabamba
        'H', // Departmento Chuquisaca
        'L', // Departmento La Paz
        'N', // Departmento Pando
        'O', // Departmento Oruro
        'P', // Departmento Potosi
        'S', // Departmento Santa Cruz
        'T', // Departmento Tarija
    );

    public $compareIdentical = true;
}

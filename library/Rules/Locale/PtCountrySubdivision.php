<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Portugal country subdivision.
 *
 * ISO 3166-1 alpha-2: PT
 *
 * @link http://www.geonames.org/PT/administrative-division-portugal.html
 */
class PtCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Aveiro
        '02', // Beja
        '03', // Braga
        '04', // Braganca
        '05', // Castelo Branco
        '06', // Coimbra
        '07', // Evora
        '08', // Faro
        '09', // Guarda
        '10', // Leiria
        '11', // Lisboa
        '12', // Portalegre
        '13', // Porto
        '14', // Santarem
        '15', // Setubal
        '16', // Viana do Castelo
        '17', // Vila Real
        '18', // Viseu
        '20', // Acores (Azores)
        '30', // Madeira
    );

    public $compareIdentical = true;
}

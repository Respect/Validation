<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Peru country subdivision.
 *
 * ISO 3166-1 alpha-2: PE
 *
 * @link http://www.geonames.org/PE/administrative-division-peru.html
 */
class PeCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AMA', // Amazonas
        'ANC', // Ancash
        'APU', // Apurimac
        'ARE', // Arequipa
        'AYA', // Ayacucho
        'CAJ', // Cajamarca
        'CAL', // Callao
        'CUS', // Cusco
        'HUC', // Huanuco
        'HUV', // Huancavelica
        'ICA', // Ica
        'JUN', // Junin
        'LAL', // La Libertad
        'LAM', // Lambayeque
        'LIM', // Lima
        'LMA', // Municipalidad Metropolitana de Lima
        'LOR', // Loreto
        'MDD', // Madre de Dios
        'MOQ', // Moquegua
        'PAS', // Pasco
        'PIU', // Piura
        'PUN', // Puno
        'SAM', // San Martin
        'TAC', // Tacna
        'TUM', // Tumbes
        'UCA', // Ucayali
    );

    public $compareIdentical = true;
}

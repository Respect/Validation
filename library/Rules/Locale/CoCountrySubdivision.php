<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Colombia country subdivision.
 *
 * ISO 3166-1 alpha-2: CO
 *
 * @link http://www.geonames.org/CO/administrative-division-colombia.html
 */
class CoCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AMA', // Amazonas
        'ANT', // Antioquia
        'ARA', // Arauca
        'ATL', // Atlantico
        'BOL', // Bolivar
        'BOY', // Boyaca
        'CAL', // Caldas
        'CAQ', // Caqueta
        'CAS', // Casanare
        'CAU', // Cauca
        'CES', // Cesar
        'CHO', // Choco
        'COR', // Cordoba
        'CUN', // Cundinamarca
        'DC', // Bogota D.C.
        'GUA', // Guainia
        'GUV', // Guaviare
        'HUI', // Huila
        'LAG', // La Guajira
        'MAG', // Magdalena
        'MET', // Meta
        'NAR', // Narino
        'NSA', // Norte de Santander
        'PUT', // Putumayo
        'QUI', // Quindio
        'RIS', // Risaralda
        'SAN', // Santander
        'SAP', // San Andres y Providencia
        'SUC', // Sucre
        'TOL', // Tolima
        'VAC', // Valle del Cauca
        'VAU', // Vaupes
        'VID', // Vichada
    );

    public $compareIdentical = true;
}

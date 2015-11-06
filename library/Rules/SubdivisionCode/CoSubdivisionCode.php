<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for Colombia subdivision code.
 *
 * ISO 3166-1 alpha-2: CO
 *
 * @link http://www.geonames.org/CO/administrative-division-colombia.html
 */
class CoSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
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
    ];

    public $compareIdentical = true;
}

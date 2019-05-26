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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class CoSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AMA', // Amazonas
        'ANT', // Antioquia
        'ARA', // Arauca
        'ATL', // Atlántico
        'BOL', // Bolívar
        'BOY', // Boyacá
        'CAL', // Caldas
        'CAQ', // Caquetá
        'CAS', // Casanare
        'CAU', // Cauca
        'CES', // Cesar
        'CHO', // Chocó
        'COR', // Córdoba
        'CUN', // Cundinamarca
        'DC', // Distrito Capital de Bogotá
        'GUA', // Guainía
        'GUV', // Guaviare
        'HUI', // Huila
        'LAG', // La Guajira
        'MAG', // Magdalena
        'MET', // Meta
        'NAR', // Nariño
        'NSA', // Norte de Santander
        'PUT', // Putumayo
        'QUI', // Quindío
        'RIS', // Risaralda
        'SAN', // Santander
        'SAP', // San Andrés, Providencia y Santa Catalina
        'SUC', // Sucre
        'TOL', // Tolima
        'VAC', // Valle del Cauca
        'VAU', // Vaupés
        'VID', // Vichada
    ];

    public $compareIdentical = true;
}

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
 * Validator for Spain subdivision code.
 *
 * ISO 3166-1 alpha-2: ES
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class EsSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'A', // Alicante
        'AB', // Albacete
        'AL', // Almería
        'AN', // Andalucía
        'AR', // Aragón
        'AS', // Asturias, Principado de
        'AV', // Ávila
        'B', // Barcelona
        'BA', // Badajoz
        'BI', // Bizkaia
        'BU', // Burgos
        'C', // A Coruña
        'CA', // Cádiz
        'CB', // Cantabria
        'CC', // Cáceres
        'CE', // Ceuta
        'CL', // Castilla y León
        'CM', // Castilla-La Mancha
        'CN', // Canarias
        'CO', // Córdoba
        'CR', // Ciudad Real
        'CS', // Castellón
        'CT', // Catalunya
        'CU', // Cuenca
        'EX', // Extremadura
        'GA', // Galicia
        'GC', // Las Palmas
        'GI', // Girona
        'GR', // Granada
        'GU', // Guadalajara
        'H', // Huelva
        'HU', // Huesca
        'IB', // Illes Balears
        'J', // Jaén
        'L', // Lleida
        'LE', // León
        'LO', // La Rioja
        'LU', // Lugo
        'M', // Madrid
        'MA', // Málaga
        'MC', // Murcia, Región de
        'MD', // Madrid, Comunidad de
        'ML', // Melilla
        'MU', // Murcia
        'NA', // Navarra / Nafarroa
        'NC', // Navarra, Comunidad Foral de / Nafarroako Foru Komunitatea
        'O', // Asturias
        'OR', // Ourense
        'P', // Palencia
        'PM', // Balears
        'PO', // Pontevedra
        'PV', // País Vasco / Euskal Herria
        'RI', // La Rioja
        'S', // Cantabria
        'SA', // Salamanca
        'SE', // Sevilla
        'SG', // Segovia
        'SO', // Soria
        'SS', // Gipuzkoa
        'T', // Tarragona
        'TE', // Teruel
        'TF', // Santa Cruz de Tenerife
        'TO', // Toledo
        'V', // Valencia / València
        'VA', // Valladolid
        'VC', // Valenciana, Comunidad / Valenciana, Comunitat
        'VI', // Álava
        'Z', // Zaragoza
        'ZA', // Zamora
    ];

    public $compareIdentical = true;
}

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
 * Validator for Guatemala subdivision code.
 *
 * ISO 3166-1 alpha-2: GT
 *
 * @link http://www.geonames.org/GT/administrative-division-guatemala.html
 */
class GtSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AV', // Alta Verapaz
        'BV', // Baja Verapaz
        'CM', // Chimaltenango
        'CQ', // Chiquimula
        'ES', // Escuintla
        'GU', // Guatemala
        'HU', // Huehuetenango
        'IZ', // Izabal
        'JA', // Jalapa
        'JU', // Jutiapa
        'PE', // El Peten
        'PR', // El Progreso
        'QC', // El Quiche
        'QZ', // Quetzaltenango
        'RE', // Retalhuleu
        'SA', // Sacatepequez
        'SM', // San Marcos
        'SO', // Solola
        'SR', // Santa Rosa
        'SU', // Suchitepequez
        'TO', // Totonicapan
        'ZA', // Zacapa
    ];

    public $compareIdentical = true;
}

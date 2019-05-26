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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
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
        'PE', // Petén
        'PR', // El Progreso
        'QC', // Quiché
        'QZ', // Quetzaltenango
        'RE', // Retalhuleu
        'SA', // Sacatepéquez
        'SM', // San Marcos
        'SO', // Sololá
        'SR', // Santa Rosa
        'SU', // Suchitepéquez
        'TO', // Totonicapán
        'ZA', // Zacapa
    ];

    public $compareIdentical = true;
}

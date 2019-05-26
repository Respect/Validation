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
 * Validator for Mexico subdivision code.
 *
 * ISO 3166-1 alpha-2: MX
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class MxSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AGU', // Aguascalientes
        'BCN', // Baja California
        'BCS', // Baja California Sur
        'CAM', // Campeche
        'CHH', // Chihuahua
        'CHP', // Chiapas
        'CMX', // Ciudad de México
        'COA', // Coahuila de Zaragoza
        'COL', // Colima
        'DUR', // Durango
        'GRO', // Guerrero
        'GUA', // Guanajuato
        'HID', // Hidalgo
        'JAL', // Jalisco
        'MEX', // México
        'MIC', // Michoacán de Ocampo
        'MOR', // Morelos
        'NAY', // Nayarit
        'NLE', // Nuevo León
        'OAX', // Oaxaca
        'PUE', // Puebla
        'QUE', // Querétaro
        'ROO', // Quintana Roo
        'SIN', // Sinaloa
        'SLP', // San Luis Potosí
        'SON', // Sonora
        'TAB', // Tabasco
        'TAM', // Tamaulipas
        'TLA', // Tlaxcala
        'VER', // Veracruz de Ignacio de la Llave
        'YUC', // Yucatán
        'ZAC', // Zacatecas
    ];

    public $compareIdentical = true;
}

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
 * Validator for Dominican Republic subdivision code.
 *
 * ISO 3166-1 alpha-2: DO
 *
 * @link http://www.geonames.org/DO/administrative-division-dominican-republic.html
 */
class DoSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Distrito Nacional
        '02', // Azua
        '03', // Baoruco
        '04', // Barahona
        '05', // Dajabon
        '06', // Duarte
        '07', // Elias Pina
        '08', // El Seybo
        '09', // Espaillat
        '10', // Independencia
        '11', // La Altagracia
        '12', // La Romana
        '13', // La Vega
        '14', // Maria Trinidad Sanchez
        '15', // Monte Cristi
        '16', // Pedernales
        '17', // Peravia (Bani)
        '18', // Puerto Plata
        '19', // Salcedo
        '20', // Samana
        '21', // San Cristobal
        '22', // San Juan
        '23', // San Pedro de Macoris
        '24', // Sanchez Ramirez
        '25', // Santiago
        '26', // Santiago Rodriguez
        '27', // Valverde
        '28', // Monsenor Nouel
        '29', // Monte Plata
        '30', // Hato Mayor
        '31', // San Jose de Ocoa
        '32', // Santo Domingo
    ];

    public $compareIdentical = true;
}

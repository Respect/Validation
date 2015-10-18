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
 * Validator for Honduras subdivision code.
 *
 * ISO 3166-1 alpha-2: HN
 *
 * @link http://www.geonames.org/HN/administrative-division-honduras.html
 */
class HnSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AT', // Atlantida
        'CH', // Choluteca
        'CL', // Colon
        'CM', // Comayagua
        'CP', // Copan
        'CR', // Cortes
        'EP', // El Paraiso
        'FM', // Francisco Morazan
        'GD', // Gracias a Dios
        'IB', // Islas de la Bahia (Bay Islands)
        'IN', // Intibuca
        'LE', // Lempira
        'LP', // La Paz
        'OC', // Ocotepeque
        'OL', // Olancho
        'SB', // Santa Barbara
        'VA', // Valle
        'YO', // Yoro
    ];

    public $compareIdentical = true;
}

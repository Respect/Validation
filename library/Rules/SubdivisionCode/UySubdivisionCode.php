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
 * Validator for Uruguay subdivision code.
 *
 * ISO 3166-1 alpha-2: UY
 *
 * @link http://www.geonames.org/UY/administrative-division-uruguay.html
 */
class UySubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AR', // Artigas
        'CA', // Canelones
        'CL', // Cerro Largo
        'CO', // Colonia
        'DU', // Durazno
        'FD', // Florida
        'FS', // Flores
        'LA', // Lavalleja
        'MA', // Maldonado
        'MO', // Montevideo
        'PA', // Paysandu
        'RN', // Rio Negro
        'RO', // Rocha
        'RV', // Rivera
        'SA', // Salto
        'SJ', // San Jose
        'SO', // Soriano
        'TA', // Tacuarembó
        'TT', // Treinta y Tres
    ];

    public $compareIdentical = true;
}

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
 * Validator for Venezuela subdivision code.
 *
 * ISO 3166-1 alpha-2: VE
 *
 * @link http://www.geonames.org/VE/administrative-division-venezuela.html
 */
class VeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'A', // Federal Capital
        'B', // Anzoategui
        'C', // Apure
        'D', // Aragua
        'E', // Barinas
        'F', // Bolivar
        'G', // Carabobo
        'H', // Cojedes
        'I', // Falcon
        'J', // Guarico
        'K', // Lara
        'L', // Merida
        'M', // Miranda
        'N', // Monagas
        'O', // Nueva Esparta
        'P', // Portuguesa
        'R', // Sucre
        'S', // Tachira
        'T', // Trujillo
        'U', // Yaracuy
        'V', // Zulia
        'W', // Federal Dependency
        'X', // Vargas
        'Y', // Delta Amacuro
        'Z', // Amazonas
    ];

    public $compareIdentical = true;
}

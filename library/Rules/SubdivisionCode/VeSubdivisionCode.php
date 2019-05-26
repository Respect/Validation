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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class VeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'A', // Distrito Federal
        'B', // Anzoátegui
        'C', // Apure
        'D', // Aragua
        'E', // Barinas
        'F', // Bolívar
        'G', // Carabobo
        'H', // Cojedes
        'I', // Falcón
        'J', // Guárico
        'K', // Lara
        'L', // Mérida
        'M', // Miranda
        'N', // Monagas
        'O', // Nueva Esparta
        'P', // Portuguesa
        'R', // Sucre
        'S', // Táchira
        'T', // Trujillo
        'U', // Yaracuy
        'V', // Zulia
        'W', // Dependencias Federales
        'X', // Vargas
        'Y', // Delta Amacuro
        'Z', // Amazonas
    ];

    public $compareIdentical = true;
}

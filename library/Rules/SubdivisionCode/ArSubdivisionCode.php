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
 * Validator for Argentina subdivision code.
 *
 * ISO 3166-1 alpha-2: AR
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class ArSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'A', // Salta
        'B', // Buenos Aires
        'C', // Ciudad Autónoma de Buenos Aires
        'D', // San Luis
        'E', // Entre Rios
        'G', // Santiago del Estero
        'H', // Chaco
        'J', // San Juan
        'K', // Catamarca
        'L', // La Pampa
        'M', // Mendoza
        'N', // Misiones
        'P', // Formosa
        'Q', // Neuquen
        'R', // Rio Negro
        'S', // Santa Fe
        'T', // Tucuman
        'U', // Chubut
        'V', // Tierra del Fuego
        'W', // Corrientes
        'X', // Cordoba
        'Y', // Jujuy
        'Z', // Santa Cruz
    ];

    public $compareIdentical = true;
}

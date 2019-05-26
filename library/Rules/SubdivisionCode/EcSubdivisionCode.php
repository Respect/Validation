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
 * Validator for Ecuador subdivision code.
 *
 * ISO 3166-1 alpha-2: EC
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class EcSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'A', // Azuay
        'B', // Bolívar
        'C', // Carchi
        'D', // Orellana
        'E', // Esmeraldas
        'F', // Cañar
        'G', // Guayas
        'H', // Chimborazo
        'I', // Imbabura
        'L', // Loja
        'M', // Manabí
        'N', // Napo
        'O', // El Oro
        'P', // Pichincha
        'R', // Los Ríos
        'S', // Morona-Santiago
        'SD', // Santo Domingo de los Tsáchilas
        'SE', // Santa Elena
        'T', // Tungurahua
        'U', // Sucumbíos
        'W', // Galápagos
        'X', // Cotopaxi
        'Y', // Pastaza
        'Z', // Zamora-Chinchipe
    ];

    public $compareIdentical = true;
}

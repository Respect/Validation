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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class HnSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AT', // Atlántida
        'CH', // Choluteca
        'CL', // Colón
        'CM', // Comayagua
        'CP', // Copán
        'CR', // Cortés
        'EP', // El Paraíso
        'FM', // Francisco Morazán
        'GD', // Gracias a Dios
        'IB', // Islas de la Bahía
        'IN', // Intibucá
        'LE', // Lempira
        'LP', // La Paz
        'OC', // Ocotepeque
        'OL', // Olancho
        'SB', // Santa Bárbara
        'VA', // Valle
        'YO', // Yoro
    ];

    public $compareIdentical = true;
}

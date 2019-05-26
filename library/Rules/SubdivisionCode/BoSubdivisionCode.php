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
 * Validator for Bolivia subdivision code.
 *
 * ISO 3166-1 alpha-2: BO
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class BoSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'B', // El Beni
        'C', // Cochabamba
        'H', // Chuquisaca
        'L', // La Paz
        'N', // Pando
        'O', // Oruro
        'P', // Potosí
        'S', // Santa Cruz
        'T', // Tarija
    ];

    public $compareIdentical = true;
}

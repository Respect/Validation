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
 * Validator for Mozambique subdivision code.
 *
 * ISO 3166-1 alpha-2: MZ
 *
 * @link http://www.geonames.org/MZ/administrative-division-mozambique.html
 */
class MzSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'A', // Niassa
        'B', // Manica
        'G', // Gaza
        'I', // Inhambane
        'L', // Maputo
        'MPM', // Maputo (city)
        'N', // Nampula
        'P', // Cabo Delgado
        'Q', // Zambezia
        'S', // Sofala
        'T', // Tete
    ];

    public $compareIdentical = true;
}

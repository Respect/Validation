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
 * @link http://www.geonames.org/BO/administrative-division-bolivia.html
 */
class BoSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'B', // Departmento Beni
        'C', // Departmento Cochabamba
        'H', // Departmento Chuquisaca
        'L', // Departmento La Paz
        'N', // Departmento Pando
        'O', // Departmento Oruro
        'P', // Departmento Potosi
        'S', // Departmento Santa Cruz
        'T', // Departmento Tarija
    ];

    public $compareIdentical = true;
}

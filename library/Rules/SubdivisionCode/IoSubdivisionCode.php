<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for British Indian Ocean Territory subdivision code.
 *
 * ISO 3166-1 alpha-2: IO
 *
 * @see http://www.geonames.org/IO/administrative-division-british-indian-ocean-territory.html
 */
class IoSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'DG', // Diego Garcia
        'DI', // Danger Island
        'EA', // Eagle Islands
        'EG', // Egmont Islands
        'NI', // Nelsons Island
        'PB', // Peros Banhos
        'SI', // Salomon Islands
        'TB', // Three Brothers
    ];

    public $compareIdentical = true;
}

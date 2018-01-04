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
 * Validator for Costa Rica subdivision code.
 *
 * ISO 3166-1 alpha-2: CR
 *
 * @see http://www.geonames.org/CR/administrative-division-costa-rica.html
 */
class CrSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'A', // Alajuela
        'C', // Cartago
        'G', // Guanacaste
        'H', // Heredia
        'L', // Limon
        'P', // Puntarenas
        'SJ', // San Jose
    ];

    public $compareIdentical = true;
}

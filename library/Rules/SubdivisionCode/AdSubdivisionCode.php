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
 * Validator for Andorra subdivision code.
 *
 * ISO 3166-1 alpha-2: AD
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class AdSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '02', // Canillo
        '03', // Encamp
        '04', // La Massana
        '05', // Ordino
        '06', // Sant Julià de Lòria
        '07', // Andorra la Vella
        '08', // Escaldes-Engordany
    ];

    public $compareIdentical = true;
}

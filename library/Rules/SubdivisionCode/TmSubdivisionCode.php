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
 * Validator for Turkmenistan subdivision code.
 *
 * ISO 3166-1 alpha-2: TM
 *
 * @link http://www.geonames.org/TM/administrative-division-turkmenistan.html
 */
class TmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'A', // Ahal Welayaty
        'B', // Balkan Welayaty
        'D', // Dashhowuz Welayaty
        'L', // Lebap Welayaty
        'M', // Mary Welayaty
        'S', // Aşgabat
    ];

    public $compareIdentical = true;
}

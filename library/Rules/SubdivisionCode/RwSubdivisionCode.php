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
 * Validator for Rwanda subdivision code.
 *
 * ISO 3166-1 alpha-2: RW
 *
 * @link http://www.geonames.org/RW/administrative-division-rwanda.html
 */
class RwSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Kigali
        '02', // Est
        '03', // Nord
        '04', // Ouest
        '05', // Sud
    ];

    public $compareIdentical = true;
}

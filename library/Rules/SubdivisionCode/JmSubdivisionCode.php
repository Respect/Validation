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
 * Validator for Jamaica subdivision code.
 *
 * ISO 3166-1 alpha-2: JM
 *
 * @link http://www.geonames.org/JM/administrative-division-jamaica.html
 */
class JmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Kingston Parish
        '02', // Saint Andrew Parish
        '03', // Saint Thomas Parish
        '04', // Portland Parish
        '05', // Saint Mary Parish
        '06', // Saint Ann Parish
        '07', // Trelawny Parish
        '08', // Saint James Parish
        '09', // Hanover Parish
        '10', // Westmoreland Parish
        '11', // Saint Elizabeth Parish
        '12', // Manchester Parish
        '13', // Clarendon Parish
        '14', // Saint Catherine Parish
    ];

    public $compareIdentical = true;
}

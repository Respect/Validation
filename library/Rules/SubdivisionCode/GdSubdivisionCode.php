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
 * Validator for Grenada subdivision code.
 *
 * ISO 3166-1 alpha-2: GD
 *
 * @link http://www.geonames.org/GD/administrative-division-grenada.html
 */
class GdSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Saint Andrew
        '02', // Saint David
        '03', // Saint George
        '04', // Saint John
        '05', // Saint Mark
        '06', // Saint Patrick
        '10', // Southern Grenadine Islands
    ];

    public $compareIdentical = true;
}

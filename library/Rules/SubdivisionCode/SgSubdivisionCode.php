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
 * Validator for Singapore subdivision code.
 *
 * ISO 3166-1 alpha-2: SG
 *
 * @link http://www.geonames.org/SG/administrative-division-singapore.html
 */
class SgSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Central Singapore
        '02', // North East
        '03', // North West
        '04', // South East
        '05', // South West
    ];

    public $compareIdentical = true;
}

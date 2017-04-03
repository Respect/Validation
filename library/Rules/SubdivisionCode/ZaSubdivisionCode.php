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
 * Validator for South Africa subdivision code.
 *
 * ISO 3166-1 alpha-2: ZA
 *
 * @link http://www.geonames.org/ZA/administrative-division-south-africa.html
 */
class ZaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'EC', // Eastern Cape
        'FS', // Free State
        'GT', // Gauteng
        'LP', // Limpopo
        'MP', // Mpumalanga
        'NC', // Northern Cape
        'NL', // KwaZulu-Natal
        'NW', // North West
        'WC', // Western Cape
    ];

    public $compareIdentical = true;
}

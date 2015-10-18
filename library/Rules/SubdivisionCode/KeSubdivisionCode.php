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
 * Validator for Kenya subdivision code.
 *
 * ISO 3166-1 alpha-2: KE
 *
 * @link http://www.geonames.org/KE/administrative-division-kenya.html
 */
class KeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '110', // Nairobi Area
        '200', // Central
        '300', // Coast
        '400', // Eastern
        '500', // North Eastern
        '600', // Nyanza
        '700', // Rift Valley
        '800', // Western
    ];

    public $compareIdentical = true;
}

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
 * Validator for Swaziland subdivision code.
 *
 * ISO 3166-1 alpha-2: SZ
 *
 * @link http://www.geonames.org/SZ/administrative-division-swaziland.html
 */
class SzSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'HH', // Hhohho
        'LU', // Lubombo
        'MA', // Manzini
        'SH', // Shishelweni
    ];

    public $compareIdentical = true;
}

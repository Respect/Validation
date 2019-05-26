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
 * Validator for Zambia subdivision code.
 *
 * ISO 3166-1 alpha-2: ZM
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class ZmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Western
        '02', // Central
        '03', // Eastern
        '04', // Luapula
        '05', // Northern
        '06', // North-Western
        '07', // Southern (Zambia)
        '08', // Copperbelt
        '09', // Lusaka
    ];

    public $compareIdentical = true;
}

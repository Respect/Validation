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
 * Validator for Bermuda subdivision code.
 *
 * ISO 3166-1 alpha-2: BM
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class BmSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'DS', // Devonshire
        'GC', // Saint George
        'HA', // Hamilton
        'HC', // Hamilton City
        'PB', // Pembroke
        'PG', // Paget
        'SA', // Sandys
        'SG', // Saint George's
        'SH', // Southampton
        'SM', // Smith's
        'WA', // Warwick
    ];

    public $compareIdentical = true;
}

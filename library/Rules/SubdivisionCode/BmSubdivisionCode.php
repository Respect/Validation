<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for Bermuda subdivision code.
 *
 * ISO 3166-1 alpha-2: BM
 *
 * @see http://www.geonames.org/BM/administrative-division-bermuda.html
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

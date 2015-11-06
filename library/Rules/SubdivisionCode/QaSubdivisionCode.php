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
 * Validator for Qatar subdivision code.
 *
 * ISO 3166-1 alpha-2: QA
 *
 * @link http://www.geonames.org/QA/administrative-division-qatar.html
 */
class QaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'DA', // Ad Dawhah
        'KH', // Al Khawr wa adh Dhakhīrah
        'MS', // Ash Shamāl
        'RA', // Ar Rayyan
        'US', // Umm Salal
        'WA', // Al Wakrah
        'ZA', // Az Z a‘āyin
    ];

    public $compareIdentical = true;
}

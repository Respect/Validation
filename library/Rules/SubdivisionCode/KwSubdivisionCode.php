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
 * Validator for Kuwait subdivision code.
 *
 * ISO 3166-1 alpha-2: KW
 *
 * @link http://www.geonames.org/KW/administrative-division-kuwait.html
 */
class KwSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AH', // Al Ahmadi
        'FA', // Al Farwaniyah
        'HA', // Hawalli
        'JA', // Al Jahra
        'KU', // Al Asimah
        'MU', // Mubārak al Kabīr
    ];

    public $compareIdentical = true;
}

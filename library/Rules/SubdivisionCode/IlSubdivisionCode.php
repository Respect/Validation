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
 * Validator for Israel subdivision code.
 *
 * ISO 3166-1 alpha-2: IL
 *
 * @link http://www.geonames.org/IL/administrative-division-israel.html
 */
class IlSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'D', // Southern
        'HA', // Haifa
        'JM', // Jerusalem
        'M', // Central
        'TA', // Tel Aviv
        'Z', // Northern
    ];

    public $compareIdentical = true;
}

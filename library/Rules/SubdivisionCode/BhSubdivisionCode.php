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
 * Validator for Bahrain subdivision code.
 *
 * ISO 3166-1 alpha-2: BH
 *
 * @link http://www.geonames.org/BH/administrative-division-bahrain.html
 */
class BhSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '13', // Capital
        '14', // Southern
        '15', // Muharraq
        '17', // Northern
    ];

    public $compareIdentical = true;
}

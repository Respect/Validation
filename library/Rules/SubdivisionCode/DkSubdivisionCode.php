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
 * Validator for Denmark subdivision code.
 *
 * ISO 3166-1 alpha-2: DK
 *
 * @link http://www.geonames.org/DK/administrative-division-denmark.html
 */
class DkSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '81', // Region Nordjylland
        '82', // Region Midtjylland
        '83', // Region Syddanmark
        '84', // Region Hovedstaden
        '85', // Region Sjæland
    ];

    public $compareIdentical = true;
}

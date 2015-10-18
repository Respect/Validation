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
 * Validator for Australia subdivision code.
 *
 * ISO 3166-1 alpha-2: AU
 *
 * @link http://www.geonames.org/AU/administrative-division-australia.html
 */
class AuSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'ACT', // Australian Capital Territory
        'NSW', // New South Wales
        'NT', // Northern Territory
        'QLD', // Queensland
        'SA', // South Australia
        'TAS', // Tasmania
        'VIC', // Victoria
        'WA', // Western Australia
    ];

    public $compareIdentical = true;
}

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
 * Validator for American Samoa subdivision code.
 *
 * ISO 3166-1 alpha-2: AS
 *
 * @see http://www.geonames.org/AS/administrative-division-american-samoa.html
 */
class AsSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'E', // Eastern
        'M', // Manu'a
        'R', // Rose Island
        'S', // Swains Island
        'W', // Western
    ];

    public $compareIdentical = true;
}

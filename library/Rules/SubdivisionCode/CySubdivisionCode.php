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
 * Validator for Cyprus subdivision code.
 *
 * ISO 3166-1 alpha-2: CY
 *
 * @link http://www.geonames.org/CY/administrative-division-cyprus.html
 */
class CySubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Lefkosía
        '02', // Lemesós
        '03', // Lárnaka
        '04', // Ammóchostos
        '05', // Páfos
        '06', // Kerýneia
    ];

    public $compareIdentical = true;
}

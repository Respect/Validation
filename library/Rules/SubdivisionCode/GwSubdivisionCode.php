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
 * Validator for Guinea-Bissau subdivision code.
 *
 * ISO 3166-1 alpha-2: GW
 *
 * @link http://www.geonames.org/GW/administrative-division-guinea-bissau.html
 */
class GwSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BA', // Bafata Region
        'BL', // Bolama Region
        'BM', // Biombo Region
        'BS', // Bissau Region
        'CA', // Cacheu Region
        'GA', // Gabu Region
        'L', // Leste
        'N', // Norte
        'OI', // Oio Region
        'QU', // Quinara Region
        'S', // Sul
        'TO', // Tombali Region
    ];

    public $compareIdentical = true;
}

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
 * Validator for Senegal subdivision code.
 *
 * ISO 3166-1 alpha-2: SN
 *
 * @link http://www.geonames.org/SN/administrative-division-senegal.html
 */
class SnSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'DB', // Diourbel
        'DK', // Dakar
        'FK', // Fatick
        'KA', // Kaffrine
        'KD', // Kolda
        'KE', // Kédougou
        'KL', // Kaolack
        'LG', // Louga
        'MT', // Matam
        'SE', // Sédhiou
        'SL', // Saint-Louis
        'TC', // Tambacounda
        'TH', // Thies
        'ZG', // Ziguinchor
    ];

    public $compareIdentical = true;
}
